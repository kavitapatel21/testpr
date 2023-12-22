<?php
/* Template Name: one page menu active
Post Type: post, page, event */
?>
<style>
    body, html {
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
    background-color:rgba(4, 180, 49, 0.6);
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
    background-color:rgba(4, 180, 49, 0.6);
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
    font-family:'Droid Sans', serif;
    font-size: 14px;
    color: #fff;
    text-decoration: none;
    line-height: 50px;
}
a {
    font-family:'Droid Sans', serif;
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
    <div id="menu-center">
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
<div id="home"></div>
<div id="portfolio"></div>
<div id="about"></div>
<div id="contact"></div>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js">
</script>
<script>
   $(document).ready(function () {
    $(document).on("scroll", onScroll);
    
    //smoothscroll
    $('.anchor').on('click', function (e) {
        e.preventDefault();
        $(document).off("scroll");
        
        $('a').each(function () {
            $(this).removeClass('active');
        })
        $(this).addClass('active');
      
        var target = this.hash,
        menu = target;
        $target = $(target);
        $('html, body').stop().animate({
            'scrollTop': $target.offset().top+2
        }, 500, 'swing', function () {
            window.location.hash = target;
            $(document).on("scroll", onScroll);
        });
    });
});

function onScroll(event){
    var scrollPos = $(document).scrollTop();
    $('#menu-center a').each(function () {
        var currLink = $(this);
        var refElement = $(currLink.attr("href"));
        
        if (refElement.position().top <= scrollPos && refElement.position().top + refElement.height() > scrollPos) {
            $('#menu-center ul li a').removeClass("active");
            currLink.addClass("active");
        }
        else{
            currLink.removeClass("active");
        }
    });
} 
</script>
