import { Controller } from '@hotwired/stimulus'

export default class extends Controller {
    static targets = ["amount", "emote"]

    // in our case the connect() method was not mandatory. We can delete it and instantiate count this way
    count = 0

    // method triggered by action "click" : data-action="click->counter#increment"
    increment() {
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
    }
}