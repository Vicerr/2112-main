import "../assets/swiper-plugin/swiper-bundle.min.js"
function getSlides() {
    return document.querySelector(".swiper-wrapper").children.length === null
        ? null
        : document.querySelector(".swiper-wrapper").children.length
}
let swiperImages = document.querySelectorAll("#swiper img")
let loadedImages = 0
swiperImages.forEach((image) => {
    loadedImages++
    image.addEventListener("load", () => {
        loadedImages === swiperImages.length
            ? null
            : (document.getElementById("swiper").style.display = "none")
    })
})
// Function to initialize Swiper with a specific stretch value
function getSwiperParams() {
    if (window.innerWidth >= 800) {
        return { stretchValue: 30, depthValue: 300 }
    } else {
        return { stretchValue: 60, depthValue: 700 }
    }
}
let params = getSwiperParams()
let swiper = new Swiper(".swiper", {
    effect: "coverflow",
    grabCursor: true,
    centeredSlides: true,
    initialSlide: Math.floor(getSlides() / 2),
    speed: 600,
    preventClicks: true,
    slidesPerView: "auto",
    coverflowEffect: {
        rotate: 0,
        stretch: params.stretchValue,
        depth: params.depthValue,
        modifier: 1,
        slideShadows: true,
    },
    autoplay: {
        delay: 2000,
        disableOnInteraction: true,
    },
    on: {
        click(event) {
            this.slideTo(this.clickedIndex)
        },
    },
    pagination: {
        el: ".swiper-pagination",
    },
})
window.addEventListener("resize", () => {
    let newParams = getSwiperParams()
    swiper.params.coverflowEffect.stretch = newParams.stretchValue
    swiper.params.coverflowEffect.depth = newParams.depthValue
    swiper.update()
})
// Function to check the screen size and apply the appropriate stretch value

// function checkScreenSize(stretchValue, depth) {
//     if (window.innerWidth >= 800) {
//         return 50 // Stretch value for large screens
//     } else {
//         return 110 // Stretch value for small screens
//     }
// }

// Initialize Swiper with the correct stretch value based on screen size
// let swiper = initializeSwiper(checkScreenSize())

// // Event listener for window resize
// window.addEventListener("resize", () => {
//     swiper.destroy(true, true) // Destroy current instance
//     swiper = initializeSwiper(checkScreenSize()) // Reinitialize with new stretch value
// })
