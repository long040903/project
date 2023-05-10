



let navbar = document.querySelector('.navbar');

document.querySelector('#menu-btn').onclick = () =>{
    navbar.classList.toggle('active');
    searchForm.classList.remove('active');
    caret.classList.remove('active');
}

window.onscroll = () =>{
    navbar.classList.remove('active');
    searchForm.classList.remove('active');
    caret.classList.remove('active');
}

let slides = document.querySelectorAll('.home .slides-container .slide');
let index = 0;

function next(){
    slides[index].classList.remove('active');
    index++;
    if(index > slides.length - 1){
        index = 0;
    }
    slides[index].classList.add('active');
}

function prev(){
    slides[index].classList.remove('active');
    index++;
    if(index > slides.length + 1){
        index = 0;
    }
    slides[index].classList.add('active');
}






