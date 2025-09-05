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
        $siteHeader.toggleClass('condensed', scrollTop > 300);
        $siteNav.toggleClass('hidden', scrollTop > 0 && scrollTop > previousScrollTop);
        $siteNav.toggleClass('condensed', scrollTop > 300);
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
                if ( windowWidth < 1360 ) {
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
    });


    /*
    $('.projectsListing').each(function (index, listingElement) {
        var $listing = $(listingElement);
        var $pagination = $listing.find('.projectsListing__pagination');
        var $itemsContainer = $listing.find('.projectsListing__items');
        var itemSelector = '.projectsListing__item';
        var step = windowWidth < 640 ? 3 : 6;
        var visibleItemsNum = step;
        var filterValue = '*';
        var matchCounter = 0;
        $itemsContainer.isotope({
            itemSelector: itemSelector,
            layoutMode: 'fitRows',
            filter: isotopeFilter
        });

        function isotopeFilter() {
            const match = filterValue === '*' || $(this).hasClass(filterValue.replace('.', ''));
            if ( match ) {
                matchCounter++;
            }
            return match && matchCounter <= visibleItemsNum;
        }

        function showMoreItems() {
            visibleItemsNum = visibleItemsNum + step;
            matchCounter = 0;
            $itemsContainer.isotope();
            $pagination.toggle( matchCounter > visibleItemsNum );
        }

        $pagination.toggle( matchCounter > visibleItemsNum );

        $pagination.on( 'click', '.link', showMoreItems );
    });
    */


    /**
     * Parallax section
     */
    /*
    function parallaxBackground() {
        var scroll = $document.scrollTop();

        $('.section--parallax').each(function (index, element) {
            var $section = $(element);
            var $sectionBg =  $section.find('.section__bg');
            var sectionTop = $section.offset().top;
            var sectionHeight = $section.outerHeight();
            var bgRatio = $sectionBg.outerHeight() / sectionHeight - 1;

            if ( sectionTop + sectionHeight > scroll && sectionTop < (scroll + windowHeight) ) {
                var offset = (scroll + windowHeight - sectionTop) / (windowHeight + sectionHeight) * sectionHeight * bgRatio;
                $sectionBg.css('translate', '0 -' + Math.round(offset) + 'px');
            }
        });
    }
    $window.on('scroll', parallaxBackground);
    parallaxBackground();
     */


    /**
     * Highlight nav items on scroll
     */
    /*
    $window.on("load scroll", function() {
        var scrollTop = $document.scrollTop();
        var scrollMiddle = scrollTop + windowHeight/2;
        $('.section').each(function (index, element) {
            var sectionTop = $(element).offset().top;
            var sectionBottom = sectionTop + windowHeight;
            var id = $(element).attr('id');
            if ( sectionTop < scrollMiddle && sectionBottom > scrollMiddle && $('.menu-item a[href*="#'+id+'"]').length ) {
                $('.menu-item').removeClass('active');
                $('.menu-item a[href*="#'+id+'"]').parents('.menu-item').addClass('active');
            }
        });
    });
    */


    /**
     * Scroll UP
     */
    /*
    $body.on('click', '#btnUp', function (e) {
        $('html, body').animate({
            scrollTop: 0
        }, 'normal');
    });
    */


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



    /**
     * Masonry align blocks
     */
    /*
    var isMasonryActive = false;
    var $masonryContainer = $('.masonry-container');
    var masonryOptions = {
        columnWidth: '.grid-sizer',
        gutter: '.gutter-sizer',
        itemSelector: '.masonry',
        percentPosition: true
    };
    $masonryContainer.imagesLoaded().progress( function() {
        $masonryContainer.masonry(masonryOptions);
    });
    */


    /**
     * Select2
     */
    /*
    $('select').select2({
        placeholder: 'Please Select One',
        minimumResultsForSearch: Infinity,
        width: '100%'
    });
    */


    /**
     * Welcome popup
     */
    /*
    $document.on("load", function () {
        if (localStorage.getItem('popup') !== 'shown') {
            $.post({
                url: selectrum.ajax_url,
                data: {
                    action: 'get_popup'
                },
                success: function ( response ) {
                    if ( response.success ) {
                        $.fancybox.open( response.data.content, {
                            touch: false,
                            autoFocus: false,
                            btnTpl: {
                                smallBtn:
                                  '<button type="button" data-fancybox-close class="fancybox-button fancybox-close-small" title="{{CLOSE}}">' +
                                  '<svg xmlns="http://www.w3.org/2000/svg" width="18.75" height="18.75" viewBox="0 0 18.75 18.75">' +
                                  '<path d="M26.25,9.388,24.362,7.5l-7.487,7.487L9.388,7.5,7.5,9.388l7.487,7.487L7.5,24.362,9.388,26.25l7.487-7.487,7.487,7.487,1.888-1.888-7.487-7.487Z" transform="translate(-7.5 -7.5)" fill="#fff"/>' +
                                  '</svg>' +
                                  '</button>'
                            }
                        } )
                        localStorage.setItem('popup', 'shown');
                    } else {
                        localStorage.removeItem('popup');
                    }
                }
            });
        }
    });
    */


    $('.featuredProjects').each(function(index, element) {
        if ( windowWidth >= 1200 ) {
            return;
        }
        const $element = $(element);
        const $container = $element.find('.projectsListing__items');
        tns({
            container: $container[0],
            loop: false,
            gutter: 16,
            autoplay: false,
            autoplayButtonOutput: false,
            autoplayHoverPause: true,
            nav: false,
            navPosition: 'bottom',
            controls: false,
            controlsPosition: 'top',
            controlsText: ['', ''],
            responsive: {
                0: {
                    items: 1
                },
                640: {
                    items: 2
                }
            }
        });
    });


    $('.logosCarousel').each(function(index, element) {
        const $element = $(element);
        const $container = $element.find('[class*="__slides"]');
        tns({
            container: $container[0],
            loop: true,
            gutter: 16,
            autoplay: false,
            autoplayButtonOutput: false,
            autoplayHoverPause: true,
            nav: true,
            navPosition: 'bottom',
            controls: true,
            controlsPosition: 'top',
            controlsText: ['', ''],
            responsive: {
                0: {
                    items: 2
                },
                640: {
                    items: 3
                },
                960: {
                    items: 4
                },
                1260: {
                    items: 5
                },
                1400: {
                    items: 6
                }
            }
        });
    });


    $('.testimonialsCarousel').each(function(index, element) {
        const $element = $(element);
        const $container = $element.find('[class*="__slides"]');
        tns({
            container: $container[0],
            loop: true,
            gutter: 20,
            autoplay: false,
            autoplayButtonOutput: false,
            autoplayHoverPause: true,
            nav: true,
            navPosition: 'bottom',
            controls: true,
            controlsPosition: 'top',
            controlsText: ['', ''],
            responsive: {
                0: {
                    items: 1
                },
                960: {
                    items: 2
                }
            }
        });
    });


    /*
    //Simple listing
    $('.postsListing').each(function (index, element) {
        var $listing = $(element);
        var $itemsContainer = $listing.find('.postsListing__items');
        var itemSelector = '.postsListing__item:has(.insightTeaser)';
        var $items = $itemsContainer.find(itemSelector);
        var $pagination = $itemsContainer.find('.postsListing__item--pagination');
        var itemsPerPage = windowWidth < 640 ? 6 : ( windowWidth < 1120 ? 7 : 10 );
        var visibleItemsNum = itemsPerPage;

        function filterItems() {
            $items.each(function (index, element) {
                var $item = $(element);
                $item.toggle( index < visibleItemsNum );
            });

            $pagination.toggle( visibleItemsNum < $items.length );
        }

        $pagination.on('click', '.postsListing__buttonMore', function(e) {
            visibleItemsNum = visibleItemsNum + itemsPerPage;
            filterItems();
        });

        filterItems();
    });
     */


    /*
    $('.isotopeListing').each(function (index, element) {
        var $this = $(element);
        var $filterDropdown = $this.find('select');
        var $filterList = $this.find('.isotopeListing__filterList');
        var $grid = $('.isotopeListing__teasers');
        var $isotope = $grid.isotope({
            // options
        });
        $filterList.on( 'click', 'a', function(e) {
            var filterValue = $(this).attr('data-filter');
            $isotope.isotope({ filter: filterValue });
            $(e.delegateTarget).find('a').removeClass('active');
            $(this).addClass('active');
            $filterDropdown.find('option[value="'+filterValue+'"]').prop('selected', 'selected');
        });
        $filterDropdown.on('change', function () {
            var filterValue = $(this).val();
            $isotope.isotope({ filter: filterValue });
            $filterList.find('a').removeClass('active');
            $filterList.find('[data-filter="'+filterValue+'"]').addClass('active');
        });
    });
    */



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
            download: '<a download data-fancybox-download class="fancybox-button fancybox-button--download" title="{{DOWNLOAD}}" href="javascript:;"></a>',
            zoom: '<button data-fancybox-zoom class="fancybox-button fancybox-button--zoom" title="{{ZOOM}}"></button>',
            close: '<button data-fancybox-close class="fancybox-button fancybox-button--close" title="{{CLOSE}}"></button>',
            arrowLeft: '<button data-fancybox-prev class="fancybox-button fancybox-button--arrow_left" title="{{PREV}}"></button>',
            arrowRight: '<button data-fancybox-next class="fancybox-button fancybox-button--arrow_right" title="{{NEXT}}"></button>',
            smallBtn: '<button type="button" data-fancybox-close class="fancybox-button fancybox-close-small" title="{{CLOSE}}"></button>'
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


    /*
    //Newsletter form
    $('.newsletter').each(function (index, element) {
        var $form = $(element);
        $form.validate({
            ignore: [],
            errorElement: "span",
            errorPlacement: function(error, element) {
                error.appendTo( element.parent() );
            },
            submitHandler: function (form) {
                var $fancybox;
                $.ajax({
                    method: 'POST',
                    url: selectrum.ajax_url,
                    data: $form.serialize(),
                    beforeSend: function() {
                        $fancybox = $.fancybox.open('<div class="fancybox-loading"></div>', {
                            touch: false,
                            autoFocus: false,
                            smallBtn: false,
                            toolbar: false,
                            modal: true
                        });
                    },
                    success: function(response) {
                        $form.validate().resetForm();
                        form.reset();
                        $fancybox.setContent( $fancybox.current, $.fancybox.defaults.btnTpl.smallBtn + response.data.content );
                    }
                });
            }
        });
    });
    */


    //Listing pagination
    $window.on('load', function () {
        $('.projectsListing').each(function (index, listingElement) {
            var $listing = $(listingElement);
            var $filterDropdown = $listing.find('select');
            var $filterButtons = $listing.find('.blogCategories__buttons');
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
            }

            function applyIsotopeFilter() {
                resetItemsHeight();
                matchCounter = 0;
                $itemsContainer.isotope();
                $pagination.toggle( matchCounter > visibleItemsNum );
                $filterButtons.find('button').removeClass('active');
                $filterButtons.find('[data-filter="'+filterValue+'"]').addClass('active');
                $filterDropdown.find('option[value="'+filterValue+'"]').prop('selected', 'selected');
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
    });



    /**
     * Maps
     */
    /*
    var mapStyles = [
        {
            "stylers": [
                {"saturation": -100}
            ]
        }
    ];
    var mapOptions = {
        zoom: 15,
        //center: new google.maps.LatLng(45.449501, -75.734891),
        mapTypeId: google.maps.MapTypeId.ROADMAP,
        noClear: true,
        disableDefaultUI: false,
        scrollwheel: false,
        draggable: true,
        zoomControl: true,
        streetViewControl: false,
        panControl: false,
        mapTypeControl: false,
        fullscreenControl: false
    };
    $('.mapContainer').each(function () {
        var markers = [];
        var $mapContainer = $(this);
        var bounds = new google.maps.LatLngBounds();
        var infoWindow = new google.maps.InfoWindow();
        var map = new google.maps.Map(this, $.extend({}, mapOptions, {}));
        map.setOptions({styles: mapStyles});
        if ( $mapContainer.data('lat') && $mapContainer.data('lng') ) {
            map.setCenter( new google.maps.LatLng( $mapContainer.data('lat'), $mapContainer.data('lng') ) );
        }
        $mapContainer.find('.mapMarker').each(function (index) {
            var $item = $(this);
            var lat = $(this).data('lat');
            var lng = $(this).data('lng');
            var iconWidth = $(this).data('icon-width');
            var iconHeight = $(this).data('icon-height');
            var iconUrlDefault = $(this).data('icon-url');
            var iconUrlActive = $(this).data('icon-url-active');
            var anchorLeft = $(this).data('anchor-left');
            var anchorTop = $(this).data('anchor-top');
            var markerIconDefault = {
                url: iconUrlDefault,
                size: new google.maps.Size(iconWidth, iconHeight),
                origin: new google.maps.Point(0, 0),
                anchor: new google.maps.Point(anchorLeft, anchorTop),
                scaledSize: new google.maps.Size(iconWidth, iconHeight)
            };
            var markerIconActive = $.extend({}, markerIconDefault, {url:iconUrlActive?iconUrlActive:iconUrlDefault});
            var marker = new google.maps.Marker({
                id: index,
                position: new google.maps.LatLng(lat, lng),
                map: map,
                draggable: false,
                icon: markerIconDefault,
                iconDefault: markerIconDefault,
                iconActive: markerIconActive,
                infoWindow: $item.html(),
            });
            google.maps.event.addListener(marker, 'click', function() {
                markers.forEach(function (marker2, i) {
                    marker2.setIcon( marker.id === marker2.id ? marker2.iconActive : marker2.iconDefault );
                });
                infoWindow.close();
                if ( marker.infoWindow ) {
                    infoWindow.setContent( marker.infoWindow );
                    infoWindow.open( map, marker );
                }
            });
            markers.push( marker );
            bounds.extend( marker.getPosition() );
        });
        if ( markers.length > 1 ) {
            map.fitBounds( bounds );
        }
        google.maps.event.addListener(map, 'click', function(event) {
            infoWindow.close();
            markers.forEach(function (marker, i) {
                markers[i].setIcon( markers[i].iconDefault );
            });
        });
    });
    */
});