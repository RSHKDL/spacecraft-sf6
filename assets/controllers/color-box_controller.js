import { Controller } from '@hotwired/stimulus'

export default class extends Controller {
    static targets = ['colorSquare', 'select']

    // The values Api
    static values = {
        colorId: Number // allow types conversion because everything from dataset is a string
    }

    connect() {
        this.selectTarget.classList.add('d-none')
    }

    selectColor(event) {
        const clickedColor = event.currentTarget.dataset.colorId
        this.colorIdValue = clickedColor == this.colorIdValue ? null : clickedColor
    }

    // callback function, naming is important
    colorIdValueChanged() {
        this.selectTarget.value = this.colorIdValue

        this.colorSquareTargets.forEach((element) => {
            if (element.dataset.colorId == this.colorIdValue) {
                element.classList.add('selected')
            } else {
                element.classList.remove('selected')
            }
        })
    }
}