$(document).ready(function() {

    /* touchMenu */
    var touch = $('#header-menu-touch');
    var menu = $('#header');

    $(touch).on('click', function(e) {
        e.preventDefault();
        menu.slideToggle(20);
    });

    $(window).resize(function() {
        var width = $(window).width();

        if (width > 1083 && menu.is(':hidden')) {
            menu.removeAttr('style');
        }
    });
    
    $("[name = date]").dateDropper();

});

/* sliderNews */
var slideIndex = 1;
showSlides(slideIndex);

function swypeSlides(number) {
    showSlides(slideIndex += number);
}

function currentSlide(number) {
    showSlides(slideIndex += number);
}

function showSlides(number) {
    var i;
    var slides = document.getElementsByClassName("news-slide");

    if (number > slides.length) {
        slideIndex = 1;
    }

    if (number < 1) {
        slideIndex = slides.length;
    }

    for(i = 0; i < slides.length; i++) {
        slides[i].style.display = "none";
    }

    slides[slideIndex - 1].style.display = "block";
}

/* redirectToPage */
function redirectToPage($location) {
    window.location.href = $location;
}

/* confirmDelete */
function confirmDelete() {
    var result = confirm('Вы уверены, что хотите выполнить удаление?');
    if (!result) return false;
}