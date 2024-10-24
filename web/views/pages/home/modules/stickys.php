<!-- start new scroll progress -->
<div class="scroll-progress-new">
    <a class="scroll-top" aria-label="scroll">
        <span class="scroll-text">Scroll</span>
        <span class="scroll-line"><span class="scroll-point" style="height: 0;"></span></span>
    </a>
</div>
<!-- end new scroll progress -->

<style>
/* Scroll progress */
.scroll-progress-new {
    position: fixed;
    right: 20px;
    z-index: 111;
    top: 50%;
    transition: all 0.3s linear;
    opacity: 0;
    visibility: hidden;
    transform: translateY(-50%);
    cursor: pointer;
}

.scroll-progress-new.visible {
    opacity: 1;
    visibility: visible;
}

.scroll-progress-new .scroll-top {
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
}

.scroll-progress-new .scroll-line {
    width: 2px;
    height: 60px;
    position: relative;
    background-color: rgba(255, 255, 255, 0.15);
    display: block;
}

.scroll-progress-new .scroll-point {
    display: inline-block;
    width: 2px;
    position: absolute;
    background-color: black;
    top: 0;
    left: 0;
}

.scroll-progress-new .scroll-text {
    transform: rotate(180deg);
    writing-mode: vertical-lr;
    margin-bottom: 15px;
    color: black; /* Cambiar a negro o al color que necesites */
    font-size: 15px;
    text-transform: uppercase;
}

.scroll-progress-new.scroll-simple {
    position: fixed;
    right: 50px;
    z-index: 111;
    top: auto;
    transform: none;
    bottom: 50px;
}

.scroll-progress-new.scroll-simple .scroll-top {
    background: var(--white);
    font-size: 17px;
    line-height: 34px;
    box-shadow: 0 0 25px rgba(23, 23, 23, 0.25);
    height: 34px;
    width: 34px;
    padding: 0;
    border-radius: 100%;
}
</style>

<script>
    /* Back to top scroll */
    $(document).on('click', '.scroll-top', function () {
        $('html, body').animate({scrollTop: 0}, 800);
        return false;
    });

    function scrollIndicator() {
        var scrollTop = $(window).scrollTop();
        var scrollHeight = $(document).height();
        var windowHeight = $(window).height();
        var maxScrollTop = scrollHeight - windowHeight;

        if (scrollTop > 200) {
            $('.scroll-progress-new').addClass('visible');
        } else {
            $('.scroll-progress-new').removeClass('visible');
        }

        // Actualizar el progreso del scroll
        var scrollPercentage = (scrollTop / maxScrollTop) * 100;
        $('.scroll-point').css('height', Math.min(scrollPercentage, 100) + '%');
    }

    $(window).scroll(function () {
        scrollIndicator();
    });
</script>
