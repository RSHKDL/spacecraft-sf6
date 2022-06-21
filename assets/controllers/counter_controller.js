import { Controller } from '@hotwired/stimulus'

export default class extends Controller {
    static targets = ["amount", "emote"];

    connect() {
        // controller property
        this.count = 0

        // basic eventListener : element is the html node where our controller is declared
        this.element.addEventListener('click', () => {
            this.count++
            // this amountTarget is possible through static targets
            this.amountTarget.innerText = this.count
            // same for emoteTarget
            if (this.count > 0) {
                this.emoteTarget.innerText = "😀"
            }
            if (this.count >= 5) {
                this.emoteTarget.innerText = "😮"
            }
        })

    }
}