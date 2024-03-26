<?php
/* Template Name: one page menu active
Post Type: post, page, event */
?>
<style>
    body,
    html {
        margin: 0;
        padding: 0;
        height: 100%;
        width: 100%;
    }

    .menu {
        width: 100%;
        height: 75px;
        background-color: rgba(0, 0, 0, 1);
        position: fixed;
        background-color: rgba(4, 180, 49, 0.6);
        -webkit-transition: all 0.3s ease;
        -moz-transition: all 0.3s ease;
        -o-transition: all 0.3s ease;
        transition: all 0.3s ease;
    }

    .light-menu {
        width: 100%;
        height: 75px;
        background-color: rgba(255, 255, 255, 1);
        position: fixed;
        background-color: rgba(4, 180, 49, 0.6);
        -webkit-transition: all 0.3s ease;
        -moz-transition: all 0.3s ease;
        -o-transition: all 0.3s ease;
        transition: all 0.3s ease;
    }

    #menu-center {
        width: 980px;
        height: 75px;
        margin: 0 auto;
    }

    #menu-center ul {
        margin: 15px 0 0 0;
    }

    #menu-center ul li {
        list-style: none;
        margin: 0 30px 0 0;
        display: inline;
    }

    .active {
        font-family: 'Droid Sans', serif;
        font-size: 14px;
        color: #fff !important;
        text-decoration: none;
        line-height: 50px;
    }

    a {
        font-family: 'Droid Sans', serif;
        font-size: 14px;
        color: black;
        text-decoration: none;
        line-height: 50px;
    }

    #home {
        background-color: grey;
        height: 100%;
        width: 100%;
        overflow: hidden;
        background-image: url(images/home-bg2.png);
    }

    #portfolio {
        background-image: url(images/portfolio-bg.png);
        height: 100%;
        width: 100%;
    }

    #about {
        background-color: blue;
        height: 100%;
        width: 100%;
    }

    #contact {
        background-color: red;
        height: 100%;
        width: 100%;
    }
</style>
<div class="m1 menu">
    <div id="menu-center" class="nav">
        <ul>
            <li><a class="active anchor" href="#home">Home</a>

            </li>
            <li><a class="anchor" href="#portfolio">Portfolio</a>

            </li>
            <li><a class="anchor" href="#about">About</a>

            </li>
            <li><a class="anchor" href="#contact">Contact</a>

            </li>
        </ul>
    </div>
</div>
<section id="home"></section>
<section id="portfolio"></section>
<section id="about"></section>
<section id="contact"></section>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script>
    // Get all sections that have an ID defined
    const sections = document.querySelectorAll("section[id]");

    // Add an event listener listening for scroll
    window.addEventListener("scroll", navHighlighter);

    function navHighlighter() {

        // Get current scroll position
        let scrollY = window.pageYOffset;

        // Now we loop through sections to get height, top and ID values for each
        sections.forEach(current => {
            const sectionHeight = current.offsetHeight;
            const sectionTop = current.offsetTop - 50;
            sectionId = current.getAttribute("id");

            /*
            - If our current scroll position enters the space where current section on screen is, add .active class to corresponding navigation link, else remove it
            - To know which link needs an active class, we use sectionId variable we are getting while looping through sections as an selector
            */
            if (
                scrollY > sectionTop && scrollY <= sectionTop + sectionHeight
            ) {
                document.querySelector(".nav a[href*=" + sectionId + "]").classList.add("active");
            } else {
                document.querySelector(".nav a[href*=" + sectionId + "]").classList.remove("active");
            }
        });
    }

    // $(document).ready(function () {
    //$(document).on("scroll", onScroll); //Onscroll chaage the active-menu as per active section

    //smoothscroll
    // $('.anchor').on('click', function (e) {
    //     e.preventDefault();
    //     $(document).off("scroll");

    //     $('a').each(function () {
    //         $(this).removeClass('active');
    //     })
    //     $(this).addClass('active');

    //     var target = this.hash,
    //     menu = target;
    //     $target = $(target);
    //     $('html, body').stop().animate({
    //         'scrollTop': $target.offset().top+2
    //     }, 500, 'swing', function () {
    //         window.location.hash = target;
    //         $(document).on("scroll", onScroll);
    //     });
    // });
    //});

    // function onScroll(event){
    //     var scrollPos = $(document).scrollTop();
    //     $('#menu-center a').each(function () {
    //         var currLink = $(this);
    //         var refElement = $(currLink.attr("href"));

    //         if (refElement.position().top <= scrollPos && refElement.position().top + refElement.height() > scrollPos) {
    //             $('#menu-center ul li a').removeClass("active");
    //             currLink.addClass("active");
    //         }
    //         else{
    //             currLink.removeClass("active");
    //         }
    //     });
    // } 
</script>