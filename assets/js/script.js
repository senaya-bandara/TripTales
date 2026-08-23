document.addEventListener("DOMContentLoaded", function () {

    /* =====================================================
       DELETE POST CONFIRMATION
    ===================================================== */

    const deleteForms = document.querySelectorAll(".delete-form");

    deleteForms.forEach(function (form) {

        form.addEventListener("submit", function (event) {

            if (!confirm("Are you sure you want to delete this blog post?")) {
                event.preventDefault();
            }

        });

    });


    /* =====================================================
       HERO SLIDER
    ===================================================== */

    const heroSlider = document.querySelector(".hero-slider");

    /*
     * If this page doesn't have a hero slider,
     * don't run the slider code.
     */

    if (!heroSlider) {
        return;
    }


    const slides = heroSlider.querySelectorAll(".hero-slide");
    const dots = heroSlider.querySelectorAll(".slider-dot");

    if (slides.length === 0) {
        return;
    }


    let currentSlide = 0;
    let autoSlideTimer;


    /* =====================================================
       SHOW SLIDE
    ===================================================== */

    function showSlide(index) {

        if (index >= slides.length) {
            index = 0;
        }

        if (index < 0) {
            index = slides.length - 1;
        }

        currentSlide = index;


        slides.forEach(function (slide, i) {

            if (i === currentSlide) {
                slide.classList.add("active");
            } else {
                slide.classList.remove("active");
            }

        });


        dots.forEach(function (dot, i) {

            if (i === currentSlide) {
                dot.classList.add("active");
            } else {
                dot.classList.remove("active");
            }

        });

    }


    /* =====================================================
       NEXT / PREVIOUS
    ===================================================== */

    function changeSlide(direction) {

        showSlide(currentSlide + direction);

        restartAutoSlide();

    }


    /* =====================================================
       DIRECT SLIDE
    ===================================================== */

    function goToSlide(index) {

        showSlide(index);

        restartAutoSlide();

    }


    /* =====================================================
       AUTO SLIDE
    ===================================================== */

    function startAutoSlide() {

        autoSlideTimer = setInterval(function () {

            showSlide(currentSlide + 1);

        }, 5000);

    }


    /* =====================================================
       RESTART TIMER
    ===================================================== */

    function restartAutoSlide() {

        clearInterval(autoSlideTimer);

        startAutoSlide();

    }


    /* =====================================================
       MAKE FUNCTIONS AVAILABLE TO HTML
    ===================================================== */

    window.changeSlide = changeSlide;
    window.goToSlide = goToSlide;


    /* =====================================================
       INITIALISE
    ===================================================== */

    showSlide(0);

    startAutoSlide();


    /* =====================================================
       PAUSE ON HOVER
    ===================================================== */

    heroSlider.addEventListener("mouseenter", function () {

        clearInterval(autoSlideTimer);

    });


    heroSlider.addEventListener("mouseleave", function () {

        startAutoSlide();

    });


    /* =====================================================
       KEYBOARD CONTROLS
    ===================================================== */

    document.addEventListener("keydown", function (event) {

        if (event.key === "ArrowLeft") {

            changeSlide(-1);

        }

        if (event.key === "ArrowRight") {

            changeSlide(1);

        }

    });

});