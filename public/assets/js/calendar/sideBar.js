var btn = document.querySelector('.toggle_btn');
var nav = document.querySelector('.sidebar');
var corp = document.querySelector('.spaceCalendar');
var filter = document.querySelector('.toggle_btn2-open');
var burger = document.querySelector('.hamburger-inner');
var filter = document.querySelector('.filter-box');



btn.onclick=function(){
    
    nav.classList.toggle('sidebar');

    corp.classList.toggle('spaceCalendar-hidden');

    filter.classList.toggle('toggle_btn2-close');

    burger.classList.toggle('hamburger-inner-menu');

    filter.classList.toggle('visible');
}

