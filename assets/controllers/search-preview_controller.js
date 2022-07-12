import { Controller } from '@hotwired/stimulus'
import { useClickOutside, useDebounce } from 'stimulus-use'

export default class extends Controller {
    static values = {
        url: String,
    }

    static targets = ['result']
    static debounces = ['search']

    connect() {
        useClickOutside(this)
        useDebounce(this, {wait: 500}) // by default debounce is 200ms
    }

    async onSearchInput(event) {
        this.search(event.currentTarget.value)
    }

    async search(query) {
        const params = new URLSearchParams({
            q: query,
            preview: 1
        })
        const response = await fetch(`${this.urlValue}?${params.toString()}`)

        this.resultTarget.innerHTML = await response.text()
    }

    clickOutside(event) {
        this.resultTarget.innerHTML = ''
    }
}