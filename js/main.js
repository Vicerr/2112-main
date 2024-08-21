// if (document.title === "Product") {
//     document.getElementById("productOrderForm").addEventListener("submit", (e) => {
//         e.preventDefault()
//     })

//     let selectButtons = document.querySelectorAll(".select-btn")
//     selectButtons.forEach((button) => {
//         button.addEventListener("click", (e) => {
//             selectButtons.forEach((button) => {
//                 button.removeAttribute("aria-current")
//                 e.target.setAttribute("aria-current", "true")
//                 document.getElementById("select").setAttribute("value", `${e.target.textContent}`)
//             })
//             document.getElementById("select").setAttribute("value", `${e.target.textContent}`)
//         })
//     })

//     let count = document.getElementById("display-order-count")
//     let currentCount = 1
//     document.getElementById("increment").addEventListener("click", increment)
//     document.getElementById("decrement").addEventListener("click", decrement)
//     function increment(e) {
//         currentCount++
//         count.textContent = currentCount
//         let parent = e.target.parentNode
//         let child = parent.querySelector("#order-number")
//         child.setAttribute("value", `${currentCount}`)
//     }
//     function decrement(e) {
//         currentCount--
//         if (currentCount < 1) {
//             currentCount = 1
//         }
//         count.textContent = currentCount
//         let parent = e.target.parentNode
//         let child = parent.querySelector("#order-number")
//         child.setAttribute("value", `${currentCount}`)
//     }
// }
// function appendImages(parentElement, star) {
//     for (let i = 0; i < star; i++) {
//         let img = document.createElement("img")
//         img.src = "assets/icons/star.svg"
//         img.alt = "star"
//         parentElement.appendChild(img)
//     }
// }
// function submitProductOrderForm() {
//     document.getElementById("productOrderForm").submit()
// }
// function appendImagesNone(parentElement, star) {
//     for (let i = 0; i < star; i++) {
//         let img = document.createElement("img")
//         img.src = "assets/icons/nostar.svg"
//         img.alt = "star"
//         parentElement.appendChild(img)
//     }
// }
// document.querySelectorAll(".card--rating, .star-rating").forEach((card) => {
//     if (!isNaN(card.dataset.rating) && card.dataset.rating <= 5 && card.dataset.rating > 0) {
//         let star = Number(card.dataset.rating)
//         appendImages(card, star)
//         appendImagesNone(card, 5 - star)
//     } else {
//         appendImagesNone(card, 5)
//     }
// })
// function submitBillingDetailsForm() {
//     document.getElementById("order-form").submit()
// }

// let deliveryType = document.querySelectorAll(".delivery-method .delivery-type")
// deliveryType.forEach((type) => {
//     type.onclick = () => {
//         deliveryType.forEach((t) => t.classList.remove("active"))
//         type.classList.add("active")
//         document
//             .getElementById("deliveryTypeInput")
//             .setAttribute("value", `${type.dataset.deliveryType}`)
//         // document.querySelectorAll("#order-form input").forEach((input) => {
//         //     if (type.dataset.deliveryType == "pickup") {
//         //         input.setAttribute("readonly", )
//         //     } else {
//         //         input.removeAttribute("disabled")
//         //     }
//         // })
//     }
// })

// function toggleNav() {
//     document.getElementById("nav-misc").classList.toggle("nav-opened")
//     document.body.classList.toggle("no-scroll")
// }

// const links = document.querySelectorAll(".nav-link")
// links.forEach((link) => {
//     let activeLink = link.getAttribute("href")
//     if (window.location.pathname == activeLink) {
//         link.setAttribute("aria-current", "true")
//     }
// })

// document.querySelectorAll(".filter--button").forEach((button) => {
//     button.onclick = () => {
//         document.querySelectorAll(".filter--button").forEach((button) => {
//             button.removeAttribute("aria-current")
//         })
//         button.setAttribute("aria-current", "true")
//         document.querySelectorAll(".product--item").forEach((product) => {
//             product.style.display = "block"
//             if (button.dataset.tag === "all") {
//                 product.style.display = "block"
//             } else if (button.dataset.tag !== product.dataset.category) {
//                 product.style.display = "none"
//             }
//         })
//     }
// })

// function openModal() {
//     document.getElementById("modal").showModal()
// }
// function closeModal() {
//     document.getElementById("modal").close()
// }

// let stars = document.querySelectorAll(".star-rating-send span")
// stars.forEach((star, index) => {
//     star.addEventListener("click", function () {
//         for (let star of stars) {
//             star.removeAttribute("data-clicked")
//         }
//         this.setAttribute("data-clicked", "true")
//         console.log(5 - index)
//         const setStarRating = document.getElementById("setStarRating")
//         setStarRating.setAttribute("value", `${5 - index}`)
//     })
// })

// let itemColor = document.querySelector(".item-color")
// itemColor.style.backgroundColor = itemColor.dataset.color

function appendImages(parentElement, star) {
    for (let i = 0; i < star; i++) {
        let img = document.createElement("img")
        img.src = "assets/icons/star.svg"
        img.alt = "star"
        parentElement.appendChild(img)
    }
}
function submitProductOrderForm() {
    document.getElementById("productOrderForm").submit()
}
function appendImagesNone(parentElement, star) {
    for (let i = 0; i < star; i++) {
        let img = document.createElement("img")
        img.src = "assets/icons/nostar.svg"
        img.alt = "star"
        parentElement.appendChild(img)
    }
}
document.querySelectorAll(".card--rating, .star-rating").forEach((card) => {
    if (!isNaN(card.dataset.rating) && card.dataset.rating <= 5 && card.dataset.rating > 0) {
        let star = Number(card.dataset.rating)
        appendImages(card, star)
        appendImagesNone(card, 5 - star)
    } else {
        appendImagesNone(card, 5)
    }
})
function submitBillingDetailsForm() {
    document.getElementById("order-form").submit()
}

function toggleNav() {
    document.getElementById("nav-misc").classList.toggle("nav-opened")
    document.body.classList.toggle("no-scroll")
}

const links = document.querySelectorAll(".nav-link")
links.forEach((link) => {
    let activeLink = link.getAttribute("href")
    if (window.location.pathname == activeLink) {
        link.setAttribute("aria-current", "true")
    }
})
document.querySelectorAll(".filter--button").forEach((button) => {
    button.onclick = () => {
        document.querySelectorAll(".filter--button").forEach((button) => {
            button.removeAttribute("aria-current")
        })
        button.setAttribute("aria-current", "true")
        document.querySelectorAll(".product--item").forEach((product) => {
            product.style.display = "block"
            if (button.dataset.tag === "all") {
                product.style.display = "block"
            } else if (button.dataset.tag !== product.dataset.category) {
                product.style.display = "none"
            }
        })
    }
})

let deliveryChoice = document.getElementById("deliveryTypeInput")
const choice = deliveryChoice.value
let deliveryType = document.querySelectorAll(".delivery-method .delivery-type")
deliveryType.forEach((type) => {
    type.onclick = () => {
        deliveryType.forEach((t) => t.classList.remove("active"))
        type.classList.add("active")
        let choice = type.dataset.deliveryType
        document
            .getElementById("deliveryTypeInput")
            .setAttribute("value", `${type.dataset.deliveryType}`)
        let inputPresent = true
        if (!inputPresent) {
            document
                .querySelectorAll(".billing-address input:not([name='deliveryType'])")
                .forEach((input) => {
                    console.log(input)
                })
        }
        hideBillingSection(choice)
    }
})
function addInputs() {
    if (!document.querySelector(".billing-address [name='address']")) {
        let billingInputs = `<label for="billing-address">Billing Address</label>
        <input type="text" name="city" id="" placeholder="City" required>
        <input type="text" name="address" id="" placeholder="Address" required>
        <input type="text" name="landmark" id="" placeholder="Closest Landmark" required>`

        let tempContainer = document.createElement("div")
        tempContainer.innerHTML = billingInputs
        while (tempContainer.firstChild) {
            document.querySelector(".billing-address").appendChild(tempContainer.firstChild)
        }
    }
}
addInputs()
function hideBillingSection(choice) {
    if (choice == "pickup") {
        document.querySelector(".billing-address [name='city']").remove()
        document.querySelector(".billing-address [name='landmark']").remove()
        document.querySelector(".billing-address [name='address']").remove()
        document.querySelector(".billing-address [for='billing-address']").remove()
    } else {
        addInputs()
        inputPresent = false
    }
}

function openModal() {
    document.getElementById("modal").showModal()
}
function closeModal() {
    document.getElementById("modal").close()
}

let stars = document.querySelectorAll(".star-rating-send span")
stars.forEach((star, index) => {
    star.addEventListener("click", function () {
        for (let star of stars) {
            star.removeAttribute("data-clicked")
        }
        this.setAttribute("data-clicked", "true")
        console.log(5 - index)
        const setStarRating = document.getElementById("setStarRating")
        setStarRating.setAttribute("value", `${5 - index}`)
    })
})

let itemColor = document.querySelector(".item-color")
if (itemColor) {
    itemColor.style.backgroundColor = itemColor.dataset.color
}
