/**
 * jQuery Validation Custom methods
 */

jQuery.validator && jQuery.validator.setDefaults({
    ignore: [],
    errorElement: "span",
    // any other default options and/or rules
    errorPlacement: function(error, element) {
        error.appendTo( element.parents('.field') );
    }
});


jQuery.ajaxSetup({
    url: selectrum.ajax_url,
    type: "POST",
    error: function(jqXHR, textStatus, errorThrown) {
        //jQuery.fancybox.open( 'Something went wrong. Please try again later or contact the website administrator.' );
    }
});


jQuery(document).ready( function($) {
    var $window = $(window);
    var $document = $(document);
    var windowWidth = $window.width();
    var windowHeight = $window.height();
    var $body = $('body');
    var $siteHeader = $('#siteHeader');
    var $siteNav = $('#siteNav');
    var headerHeight = $siteHeader.outerHeight();

    $window.resize(function () {
        windowWidth = $window.width();
        windowHeight = $window.height();
        headerHeight = $siteHeader.outerHeight();
    });


    /**
     * Process Scroll event
     */
    let previousScrollTop = 0;
    $window.on("load scroll", function () {
        let scrollTop = $document.scrollTop();
        $body.toggleClass('scrolled', Boolean(scrollTop));
        $siteHeader.toggleClass('hidden', scrollTop > 0 && scrollTop > previousScrollTop);
        $siteHeader.toggleClass('condensed', scrollTop > 60);
        $siteNav.toggleClass('hidden', scrollTop > 0 && scrollTop > previousScrollTop);
        $siteNav.toggleClass('condensed', scrollTop > 60);
        previousScrollTop = scrollTop;
    });


    /**
     * Process hash links
     */
    $body.on('click', 'a[href*=\\#]', function (e) {

        if ( $(this).hasClass('ui-tabs-anchor') )
            return false;

        var url = $(this).attr('href');
        var hash = url.substring(url.indexOf('#'));
        if ($(hash).length) {
            e.preventDefault();
            processHash(hash);
        }
    });

    function processHash(hash) {
        var $element = $(hash);
        var hashValue = hash.substr(1);

        if ($element.length) {
            var elementOffset = $element.offset().top;
            var elementHeight = $element.outerHeight();
            var elementCenter = elementOffset + elementHeight/2;

            $('html, body').animate({
                scrollTop: elementHeight > windowHeight ? elementOffset : elementCenter - windowHeight/2
            }, 'normal');
        }
    }

    $window.on("load", function () {
        if (window.location.hash) {
            processHash(window.location.hash);
        }
    });



    /**
     * Menu
     */
    var $menu = {
        list: $siteNav,
        btn: $('#btnMenu'),
        btnClose: $('#btnMenuClose'),
        init: function () {
            $body.append('<div id="navOverlay" class="navOverlay"/>');
            $menu.btn.on('click', $menu.toggle);
            $menu.btnClose.on('click', $menu.close);
            $menu.list.on('click', '.menu-item-has-children > .menu-item-link-wrapper', function (e) {
                if ( windowWidth < 1200 ) {
                    e.preventDefault();
                    var $button = $(this);
                    var $item = $button.parents('.menu-item');
                    $item.find('.sub-menu').slideToggle();
                    $item.toggleClass('open');
                }
            });
        },
        toggle: function (e) {
            $menu.isOpen() ? $menu.close(e) : $menu.open(e);
        },
        open: function (e) {
            e.stopPropagation();
            $siteHeader.addClass('siteHeader--navVisible');
            $menu.btn.addClass('close');
            $menu.list.addClass('siteNav--visible');
            $('#navOverlay').addClass('navOverlay--visible');
            //$body.css('overflow', 'hidden');
        },
        close: function (e) {
            $siteHeader.removeClass('siteHeader--navVisible');
            $menu.btn.removeClass('close');
            $menu.list.removeClass('siteNav--visible');
            $('#navOverlay').removeClass('navOverlay--visible');
            //$body.css('overflow', '');
        },
        isOpen: function () {
            return $menu.list.hasClass('siteNav--visible');
        }
    };
    $menu.init();


    /*const lenis = new Lenis({
        autoRaf: true,
    });*/


    /**
     * AOS
     */
    AOS.init({
        duration: 600,
        offset: 50
    });
    $window.resize(function () {
        AOS.refresh();
    });


    function stepsHandler() {
        $('.step__number').each(function (index, element) {
            if ( $(element).offset().top < $document.scrollTop() + windowHeight/2 ) {
                $('.step__number').removeClass('active');
                $(element).addClass('active');
            } else {
                $(element).removeClass('active');
            }
        })
    }
    stepsHandler();
    $window.on('scroll resize', stepsHandler);


    $document.on('wpcf7mailsent',function (e) {
        $('.contactFormBlock__formContainer').hide();
        $('.contactFormBlock__response').show();
    });


    /**
     * jQuery UI Accordion
     */
    $('.accordion').accordion({
        active: false,
        collapsible: true,
        heightStyle: "content",
        header: '.accordion__header',
        beforeActivate: function( event, ui ) {
            //$(ui.oldHeader).parents('.accordion__item').removeClass('active');
            //$(ui.newHeader).parents('.accordion__item').addClass('active');
        },
        activate: function( event, ui ) {
            if(!$.isEmptyObject(ui.newHeader.offset())) {
                //$('html:not(:animated), body:not(:animated)').animate({ scrollTop: ui.newHeader.offset().top - headerHeight - 30 }, 'normal');
            }
        }
    });


    let tinySlider = null;
    function featuredProjectsHandler() {
        if ( windowWidth < 1200 && $('.featuredProjects .projectsListing__items').length ) {
            if ( tinySlider === null || tinySlider.destroy === null ) {
                tinySlider = tns({
                    container: '.featuredProjects .projectsListing__items',
                    loop: false,
                    gutter: 16,
                    autoplay: false,
                    autoplayButtonOutput: false,
                    autoplayHoverPause: true,
                    nav: false,
                    navPosition: 'bottom',
                    controls: true,
                    controlsPosition: 'bottom',
                    controlsText: ['',''],
                    responsive: {
                        0: {
                            items: 1
                        },
                        640: {
                            items: 2
                        }
                    }
                });
            }
        } else {
            if ( tinySlider !== null && tinySlider.destroy !== null ) {
                tinySlider.destroy();
            }
        }
    }
    featuredProjectsHandler();
    $window.on('resize', featuredProjectsHandler);


    $('.heroSlider').each(function(index, element) {
        const $element = $(element);
        const $container = $element.find('[class*="__slides"]');
        tns({
            container: $container[0],
            items: 1,
            loop: true,
            gutter: 0,
            autoplay: true,
            autoplayTimeout: 4000,
            autoplayButtonOutput: false,
            autoplayHoverPause: true,
            nav: false,
            controls: true,
            controlsPosition: 'bottom',
            controlsText: ['', ''],
            controlsContainer: '.heroSlider__controls',
        });

        $element.find('.heroSlider__mediaBlock').css('height', windowHeight + 'px');
    });


    $('.projectGallery').each(function(index, element) {
        const $element = $(element);
        const $container = $element.find('[class*="__slides"]');
        tns({
            container: $container[0],
            items: 1,
            loop: true,
            gutter: 0,
            autoplay: true,
            autoplayTimeout: 4000,
            autoplayButtonOutput: false,
            autoplayHoverPause: true,
            nav: true,
            navPosition: 'bottom',
            controls: true,
            controlsPosition: 'bottom',
            controlsText: ['','']
        });
    });


    let testimonialsSlider = null;
    function testimonialsHandler() {
        if ( windowWidth < 1200 && $('.testimonials').length ) {
            if ( testimonialsSlider === null || testimonialsSlider.destroy === null ) {
                testimonialsSlider = tns({
                    container: '.testimonials__items',
                    loop: false,
                    gutter: 16,
                    autoplay: false,
                    autoplayButtonOutput: false,
                    autoplayHoverPause: true,
                    nav: false,
                    controls: false,
                    responsive: {
                        0: {
                            items: 1
                        },
                        960: {
                            items: 2,
                            gutter: 64
                        }
                    }
                });
            }
        } else {
            if ( testimonialsSlider !== null && testimonialsSlider.destroy !== null ) {
                testimonialsSlider.destroy();
            }
        }
    }
    testimonialsHandler();
    $window.on('resize', testimonialsHandler);


    let articlesSlider = null;
    function articlesHandler() {
        if ( windowWidth < 1200 && $('.latestArticlesListing').length ) {
            if ( articlesSlider === null || articlesSlider.destroy === null ) {
                articlesSlider = tns({
                    container: '.latestArticlesListing__items',
                    loop: false,
                    gutter: 16,
                    autoplay: false,
                    autoplayButtonOutput: false,
                    autoplayHoverPause: true,
                    nav: false,
                    controls: true,
                    controlsPosition: 'bottom',
                    controlsText: ['',''],
                    responsive: {
                        0: {
                            items: 1
                        },
                        640: {
                            items: 2
                        },
                        960: {
                            items: 3
                        }
                    }
                });
            }
        } else {
            if ( articlesSlider !== null && articlesSlider.destroy !== null ) {
                articlesSlider.destroy();
            }
        }
    }
    articlesHandler();
    $window.on('resize', articlesHandler);



    $('[data-fancybox]').fancybox({
        infobar: false,
        toolbar: true,
        smallBtn: false,
        buttons: [
            //"zoom",
            //"share",
            //"slideShow",
            //"fullScreen",
            //"download",
            //"thumbs",
            "close"
        ],
        btnTpl: {
            //download: '<a download data-fancybox-download class="fancybox-button fancybox-button--download" title="{{DOWNLOAD}}" href="javascript:;"></a>',
            //zoom: '<button data-fancybox-zoom class="fancybox-button fancybox-button--zoom" title="{{ZOOM}}"></button>',
            //close: '<button data-fancybox-close class="fancybox-button fancybox-button--close" title="{{CLOSE}}"></button>',
            //arrowLeft: '<button data-fancybox-prev class="fancybox-button fancybox-button--arrow_left" title="{{PREV}}"></button>',
            //arrowRight: '<button data-fancybox-next class="fancybox-button fancybox-button--arrow_right" title="{{NEXT}}"></button>',
            //smallBtn: '<button type="button" data-fancybox-close class="fancybox-button fancybox-close-small" title="{{CLOSE}}"></button>'
        },
        mobile: {
            clickContent: function(current, event) {
                return current.type === "image" ? false : false;
            },
            clickSlide: function(current, event) {
                return current.type === "image" ? "close" : "close";
            },
        },
    });


    //Projects listing
    $('.projectsListing--isotope').each(function (index, listingElement) {
        var $listing = $(listingElement);
        var $filterDropdown = $listing.find('select');
        var $filterButtons = $listing.find('.projectsListing__buttons');
        var $itemsContainer = $listing.find('.projectsListing__items');
        var itemSelector = '.projectsListing__item';
        var $items = $itemsContainer.find(itemSelector);
        var $pagination = $listing.find('.projectsListing__pagination');
        var step = windowWidth < 640 ? 3 : 6;
        var visibleItemsNum = step;
        var filterValue = '*';
        var matchCounter = 0;
        var $isotope = $itemsContainer.isotope({
            itemSelector: itemSelector,
            layoutMode: 'fitRows',
            filter: isotopeFilter
        });

        function resetItemsHeight() {
            $items.css('height', '');
            $items.each(function (index, element) {
                var $item = $(element);
                $item.css('height', $item.outerHeight());
            });
        }

        function showMoreItems() {
            visibleItemsNum = visibleItemsNum + step;
            matchCounter = 0;
            $itemsContainer.isotope();
            $pagination.toggle( matchCounter > visibleItemsNum );
            AOS.refresh();
        }

        function applyIsotopeFilter() {
            resetItemsHeight();
            matchCounter = 0;
            $itemsContainer.isotope();
            $pagination.toggle( matchCounter > visibleItemsNum );
            $filterButtons.find('button').removeClass('active');
            $filterButtons.find('[data-filter="'+filterValue+'"]').addClass('active');
            $filterDropdown.find('option[value="'+filterValue+'"]').prop('selected', 'selected');
            AOS.refresh();
        }

        function alignItemsHeight() {
            let itemsInRow = [];
            let rowHeight = 0;
            const filteredElements = $itemsContainer.isotope('getFilteredItemElements');
            resetItemsHeight();
            filteredElements.forEach(function (element, index) {
                var $item = $(element);
                if ( index > 0 ) {
                    if ( $item.offset().top === $(filteredElements[index-1]).offset().top ) {
                        itemsInRow.push( $item );
                        rowHeight = $item.outerHeight() > rowHeight ? $item.outerHeight() : rowHeight;
                    }
                    else {
                        itemsInRow.forEach(function ($item) {
                            $item.css('height', rowHeight);
                        });
                        itemsInRow = [ $item ];
                        rowHeight = $item.outerHeight();
                    }
                } else {
                    itemsInRow.push( $item );
                    rowHeight = $item.outerHeight();
                }
                if ( index === filteredElements.length - 1 ) {
                    itemsInRow.forEach(function ($item) {
                        $item.css('height', rowHeight);
                    });
                }
            });
        }

        function isotopeFilter() {
            var match = filterValue === '*' || $(this).hasClass( filterValue.replace('.', '') );
            if ( match ) {
                matchCounter++;
            }
            return match && matchCounter <= visibleItemsNum;
        }

        function hashHandler() {
            if ( location.hash && $items.filter('.' + location.hash.substring(1)).length ) {
                filterValue = '.' + location.hash.substring(1);
                applyIsotopeFilter();
            }
        }

        alignItemsHeight();
        hashHandler();
        $isotope.on( 'layoutComplete', alignItemsHeight);
        $filterButtons.on( 'click', 'button', function(e) {
            filterValue = $(this).attr('data-filter');
            applyIsotopeFilter();
        });
        $filterDropdown.on('change', function () {
            filterValue = $(this).val();
            applyIsotopeFilter();
        });
        $pagination.on('click', '.link', showMoreItems);
    });


    //Blog listing
    $('.blogListing').each(function (index, listingElement) {
        var $listing = $(listingElement);
        var $filterDropdown = $listing.find('select');
        var $itemsContainer = $listing.find('.blogListing__items');
        var itemSelector = '.blogListing__item';
        var $items = $itemsContainer.find(itemSelector);
        var $pagination = $listing.find('.blogListing__pagination');
        var step = windowWidth < 640 ? 4 : ( windowWidth < 1600 ? 6 : 8 );
        var visibleItemsNum = step;
        var filterValue = '*';
        var matchCounter = 0;
        var $isotope = $itemsContainer.isotope({
            itemSelector: itemSelector,
            layoutMode: 'fitRows',
            filter: isotopeFilter
        });

        function resetItemsHeight() {
            $items.css('height', '');
            $items.each(function (index, element) {
                var $item = $(element);
                $item.css('height', $item.outerHeight());
            });
        }

        function showMoreItems() {
            visibleItemsNum = visibleItemsNum + step;
            matchCounter = 0;
            $itemsContainer.isotope();
            $pagination.toggle( matchCounter > visibleItemsNum );
            AOS.refresh();
        }

        function applyIsotopeFilter() {
            resetItemsHeight();
            matchCounter = 0;
            $itemsContainer.isotope();
            $pagination.toggle( matchCounter > visibleItemsNum );
            $filterDropdown.find('option[value="'+filterValue+'"]').prop('selected', 'selected');
            AOS.refresh();
        }

        function alignItemsHeight() {
            let itemsInRow = [];
            let rowHeight = 0;
            const filteredElements = $itemsContainer.isotope('getFilteredItemElements');
            resetItemsHeight();
            filteredElements.forEach(function (element, index) {
                var $item = $(element);
                if ( index > 0 ) {
                    if ( $item.offset().top === $(filteredElements[index-1]).offset().top ) {
                        itemsInRow.push( $item );
                        rowHeight = $item.outerHeight() > rowHeight ? $item.outerHeight() : rowHeight;
                    }
                    else {
                        itemsInRow.forEach(function ($item) {
                            $item.css('height', rowHeight);
                        });
                        itemsInRow = [ $item ];
                        rowHeight = $item.outerHeight();
                    }
                } else {
                    itemsInRow.push( $item );
                    rowHeight = $item.outerHeight();
                }
                if ( index === filteredElements.length - 1 ) {
                    itemsInRow.forEach(function ($item) {
                        $item.css('height', rowHeight);
                    });
                }
            });
        }

        function isotopeFilter() {
            var match = filterValue === '*' || $(this).hasClass( filterValue );
            if ( match ) {
                matchCounter++;
            }
            return match && matchCounter <= visibleItemsNum;
        }

        function hashHandler() {
            if ( location.hash && $items.filter(location.hash.substring(1)).length ) {
                filterValue = location.hash.substring(1);
                applyIsotopeFilter();
            }
        }

        alignItemsHeight();
        hashHandler();
        $isotope.on( 'layoutComplete', alignItemsHeight);
        $filterDropdown.on('change', function () {
            filterValue = $(this).val();
            applyIsotopeFilter();
        });
        $pagination.on('click', '.link', showMoreItems);
    });
});