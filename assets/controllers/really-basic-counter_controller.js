import { Controller } from '@hotwired/stimulus'

export default class extends Controller {
    connect() {
        // controller property
        this.count = 0

        // element is the html node where our controller is declared (the full div)
        this.element.innerHTML = 'I have not been clicked yet...';

        // basic eventListener
        this.element.addEventListener('click', () => {
            this.count++
            this.element.innerHTML = this.count
        })
    }
}