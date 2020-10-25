jQuery(function($) {
    $(".mobile-menu-button").on("click", function() {
        $(this).toggleClass('open').next().slideToggle();
    })

    function toggleSubNav(toggle) {
        toggle.toggleClass('sub-menu-open').find('.sub-menu').slideToggle();
    }

    $('.menu-item-has-children').on('click', function(e) {
        e.stopPropagation();
        if (this === e.target) {
            toggleSubNav($(this));
        }
    })



    function restoreBodyScroll() {
        const body = document.body;
        const scrollY = body.style.top;
        body.style.position = '';
        body.style.top = '';
        document.documentElement.style.scrollBehavior = 'auto';
        window.scrollTo(0, parseInt(scrollY || '0') * -1);
        document.documentElement.style.scrollBehavior = 'smooth';
    }
    
    function removeBodyScroll() {
        const scrollY = document.documentElement.style.getPropertyValue('--scroll-y');
        const body = document.body;
        body.style.position = 'fixed';
        body.style.top = `-${scrollY}`;
    }
    
    // Track scroll position in order to properly set/reset modal close
    function scrollListener() {
        window.addEventListener('scroll', () => {
            document.documentElement.style.setProperty('--scroll-y', `${window.scrollY}px`);
        });
    }
})

