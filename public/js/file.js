document.querySelector("body").setAttribute("oncontextmenu", "return false")

// 1. Select the element with the class 'scroll-top'

window.addEventListener("scroll", ()=>{
    let offset = window.scrollY
    if(offset > 10){
        document.querySelector("nav").style.transform = "translateY(-60px)"
    }else{
        document.querySelector("nav").style.transform = "translateY(0px)"
    }
})