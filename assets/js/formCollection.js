/**
 * Courtesy of symfony
 * @see https://symfony.com/doc/current/form/form_collections.html
 * @todo use stimulus instead!
 */

const addPaintJob = document.querySelector('.js_add_item_link')
if (null !== addPaintJob) {
    addPaintJob.addEventListener('click', addFormToCollection)
}

document.querySelectorAll('ul.js-paint-jobs-holder li').forEach((element) => {
    addFormDeleteLink(element)
})

function addFormToCollection(e) {
    const collectionHolder = document.querySelector('.' + e.currentTarget.dataset.collectionHolderClass)
    const item = document.createElement('li')
    item.classList.add('list-group-item', 'py-3')

    item.innerHTML = collectionHolder
        .dataset
        .prototype
        .replace(
            /__name__/g,
            collectionHolder.dataset.index
        )

    collectionHolder.appendChild(item)
    collectionHolder.dataset.index++
    addFormDeleteLink(item)
}

function addFormDeleteLink(element) {
    const removeFormButton = document.createElement('button')
    removeFormButton.innerText = 'Delete this paint job'
    removeFormButton.classList.add('btn', 'btn-sm', 'btn-danger')

    element.append(removeFormButton)

    removeFormButton.addEventListener('click', (e) => {
        e.preventDefault()
        // remove the li
        element.remove()
    })
}