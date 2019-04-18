var btn = document.querySelector('.toggle_btn');
var nav = document.querySelector('.sidebar');
var corp = document.querySelector('.spaceCalendar');
var filter = document.querySelector('.toggle_btn2-open');




btn.onclick=function(){
    nav.classList.toggle('sidebar-hidden');

    corp.classList.toggle('spaceCalendar-hidden');

    filter.classList.toggle('toggle_btn2-close');
}

