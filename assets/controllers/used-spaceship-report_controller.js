import { Controller } from '@hotwired/stimulus'

export default class extends Controller {

    static values = {
        url: String,
    }

    static targets = ['result']

    async ask() {
        const response = await fetch(`${this.urlValue}`)
        this.removeClassWithPrefix(this.resultTarget, 'bg-')
        // https://developer.mozilla.org/en-US/docs/Web/API/Response/json
        try {
            const decodedJson = await response.json()
            if (null === decodedJson) {
                this.displayError(this.resultTarget)
            } else {
                this.resultTarget.classList.add(`bg-${decodedJson}`)
                this.resultTarget.innerHTML = decodedJson
            }
        } catch (error) {
            this.displayError(this.resultTarget)
        }
    }

    removeClassWithPrefix(node, prefix) {
        node.classList.forEach(className => {
            if (className.startsWith(prefix)) {
                node.classList.remove(className)
            }
        })
    }

    displayError(node) {
        node.classList.add('bg-danger')
        node.innerHTML = 'An error occurred'
    }
}