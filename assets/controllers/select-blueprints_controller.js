import { Controller } from '@hotwired/stimulus'

export default class extends Controller {
    static targets = ['blueprints']

    initialize() {
        this.originalBlueprints = null // Allow to keep track of the original json
        this.filteredBlueprints = null // Allow to keep track of the filtered json
    }

    connect() {
        this.filteredBlueprints = this.originalBlueprints = JSON.parse(this.blueprintsTarget.dataset.blueprints)
        // selectNodes that use this system are flagged by a className
        const selectNodes = document.getElementsByClassName('js-select-node')

        // Step 1 : add options for first select
        this.appendOption(selectNodes[0], this.filteredBlueprints)
        // Step 2 : filter full json, at each select used
        for (let index = 0; index < selectNodes.length; index++) {
            const node = selectNodes[index]
            const nextNode = selectNodes[index + 1]
            // Fat arrow syntax to access "this" and know it is referring to the parent scope
            node.addEventListener('change', (event) => {
                const mode = event.currentTarget.dataset.selectMode
                const type = event.currentTarget.dataset.selectType
                const valueSelected = event.currentTarget.value

                // Rollback choices if another select than the next one is used
                const previousNodes = Array.from(selectNodes).filter((item, itemIndex) => itemIndex <= index)
                const nextNodes = Array.from(selectNodes).filter((item, itemIndex) => itemIndex > index)
                let previousNodesFirstIteration = true
                for (let previousNode of previousNodes) {
                    const previousMode = previousNode.dataset.selectMode
                    const previousType = previousNode.dataset.selectType
                    const previousValueSelected = previousNode.value
                    if (previousNodesFirstIteration) {
                        previousNodesFirstIteration = false
                        // At the first iteration we need to start filtering from the original json
                        this.filteredBlueprints = this.filterBlueprints(this.originalBlueprints, previousMode, previousType, previousValueSelected)
                    } else {
                        // After the first iteration we can filter new filtered json again
                        this.filteredBlueprints = this.filterBlueprints(this.filteredBlueprints, previousMode, previousType, previousValueSelected)
                    }
                }
                let nextNodesFirstIteration = true
                for (let nextNode of nextNodes) {
                    nextNode.value = ''
                    // remove options except the first one
                    nextNode.querySelectorAll('option:not(:first-child)').forEach((option) => option.remove())
                    // Append new options to the next node
                    if (nextNodesFirstIteration) {
                        nextNodesFirstIteration = false
                        this.appendOption(nextNode, this.filteredBlueprints)
                    }
                }
            })
        }
        // Step 3 : improvements ?
        // todo: handle disabled/enabled select
        // Step 4 : Reset the form when the DOM change
        // (i.e. the form is submitted but the user use browser history to go back on the form again)
        // @see https://developer.mozilla.org/en-US/docs/Web/API/Document/visibilitychange_event
        document.addEventListener('visibilitychange', () => {
            const form = document.getElementById('select-blueprints-form')
            form.reset()
        })
    }

    /**
     * Basically... just add options to select.
     * Deduplicate an array of possible options and add them in a format dependent of the select mode.
     * Atm, support 'basic' and 'combinatorial' modes. Naming is important, atm support somethingId
     * and somethingName in the json.
     *
     * @param node HTML Select Node
     * @param json Json
     */
    appendOption(node, json) {
        const type = node.dataset.selectType
        const mode = node.dataset.selectMode
        let items = []

        if ('basic' === mode) {
            for (let key in json) {
                const idProperty = type + 'Id'
                const nameProperty = type + 'Name'
                items.push({id: json[key][idProperty], name: json[key][nameProperty]})
            }
            // ES6+ magic to deduplicate an array using map (using item ID)
            items = [...new Map(items.map(item => [item['id'], item])).values()]
            for (let item of items) {
                node.add(new Option(item.name, item.id))
            }
        }

        if ('combinatorial' === mode) {
            for (let key in json) {
                items.push({name: json[key][type]})
            }
            // ES6+ magic to deduplicate an array using map (using item NAME)
            items = [...new Map(items.map(item => [item['name'], item])).values()]
            for (let item of items) {
                null === item.name ? item.name = 'none' : item.name
                node.add(new Option(item.name, item.name))
            }
        }
    }

    /**
     * Filter an array of blueprint according to a selectedValue.
     * Atm, support 'basic' and 'combinatorial' modes
     * Naming is important, atm support somethingId and somethingName in the json
     *
     * @param blueprints Json
     * @param mode string
     * @param type string
     * @param selectedValue string
     * @returns {*} Json
     */
    filterBlueprints(blueprints, mode, type, selectedValue) {
        let filteredBlueprints = null
        if ('basic' === mode) {
            const id = type + 'Id'
            filteredBlueprints = blueprints.filter(item => item[id] === Number(selectedValue))
        }

        if ('combinatorial' === mode) {
            filteredBlueprints = blueprints.filter(item => item[type] === selectedValue)
        }

        return filteredBlueprints
    }
}
