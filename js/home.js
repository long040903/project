



let navbar = document.querySelector('.navbar');

document.querySelector('#menu-btn').onclick = () =>{
    navbar.classList.toggle('active');
    caretDownMenu.classList.remove("show");
    cart.classList.remove('active');
}

window.onscroll = () =>{
    navbar.classList.remove('active');
    caretDownMenu.classList.remove("show");
    cart.classList.remove('active');
}
let cart = document.querySelector('.shopping-cart');

document.querySelector('#cart-btn').onclick = () =>{
    cart.classList.toggle('active');
    navbar.classList.remove('active');
    caretDownMenu.classList.remove("show");
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






const allSideMenu = document.querySelectorAll('#sidebar .side-menu.top li a');

allSideMenu.forEach(item=> {
	const li = item.parentElement;

	item.addEventListener('click', function () {
		allSideMenu.forEach(i=> {
			i.parentElement.classList.remove('active');
		})
		li.classList.add('active');
	})
});




// TOGGLE SIDEBAR
const menuBar = document.querySelector('#content nav .bx.bx-menu');
const sidebar = document.getElementById('sidebar');

menuBar.addEventListener('click', function () {
	sidebar.classList.toggle('hide');
})







