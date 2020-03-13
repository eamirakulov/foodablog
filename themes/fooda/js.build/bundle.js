jQuery(function ($) {

    window.onpopstate = function(event) {
        //console.log(JSON.stringify(event.state), event.state, window.location, event);
        var loadedCat = event.state.id ? parseInt(event.state.id) : 0;
        $('.current-cat').removeClass('current-cat');
        $('a[data-cat="'+loadedCat+'"]').parent().addClass('current-cat');
        window.activeCategory = parseInt(event.state.id);
        window.timesRan = 0;
        window.pageToLoad = 1;
        if(parseInt(event.state.id) > 0){
            $('.post-card').each(function(index, item){
                if( $(item).data('cat') === parseInt(event.state.id) ){
                    $(item).addClass('is-visible');
                } else {
                    $(item).removeClass('is-visible');
                }
            })
        } else {
            $('.post-card').each(function(index, item){
                $(item).addClass('is-visible');
            })
        }
    };


    $('.category-nav a').on('click', function(event){
        event.preventDefault();
        $('.current-cat').removeClass('current-cat');
        $(this).parent().addClass('current-cat');
        var catId = $(this).data('cat');
        window.activeCategory = parseInt(catId);
        window.timesRan = 0;
        window.pageToLoad = 1;
        if(catId > 0){
            $('.post-card').each(function(index, item){
                if( $(item).data('cat') === catId ){
                    $(item).addClass('is-visible');
                } else {
                    $(item).removeClass('is-visible');
                }
            })
        } else {
            $('.post-card').each(function(index, item){
                $(item).addClass('is-visible');
            })
        }
        window.history.pushState({id:catId}, 'new title', $(this).attr('href'));
    });

    $(document).on('ready', function () {
        $('.category-nav li').removeClass('current-cat');
        $('a[data-cat="0"]').parent().addClass('current-cat');
    });

    window.allowInfiniteScroll = true;
    window.timesRan = 0;
    window.pageToLoad = 2;
    if(window.allowInfiniteScroll === true){
        var loading = false;
        var scrollHandling = {
            allow: true,
            reallow: function () {
                scrollHandling.allow = true;
            },
            delay: 800
        };
        $(window).scroll(function () {
            if (!loading && scrollHandling.allow) { // /*&& window.timesRan < 3*/ scrollHandling.allow
                scrollHandling.allow = false;
                setTimeout(scrollHandling.reallow, scrollHandling.delay);
                var offset = $('#footer').offset().top - $(window).scrollTop();
                if (2000 > offset) {
                    loading = true;
                    window.timesRan++;
                    var postsOnPage = $('.post-card').map(function() {return $(this).data('postid');}).get().join('|');
                    var data = {
                        action: 'fooda_ajax_load_more',
                        page: window.pageToLoad,
                        query: window.foodaloadmore,
                        category : window.activeCategory,
                        postsNotIn : postsOnPage
                    };
                    $.post(window.adminUrl , data, function (res) {
                        if (res.success) {
                            $('.post-cards-grid').append(res.data);
                            window.pageToLoad++;
                            loading = false;
                        } else {
                            console.log(res);
                        }
                    }).fail(function (xhr, textStatus, e) {
                        console.log(xhr.responseText);
                    });
                }
            }
        });
    }
});

'use strict';
(function ($) {
    // Hide Header on on scroll down
    var didScroll;
    var lastScrollTop = 0;
    var delta = 5;
    var navbarHeight;
    var header;
    var st;

    $(document).ready(function () {

        header = $('.navbar-fixed-top');
        navbarHeight = header.outerHeight();

        $(window).scroll(function(event){
            didScroll = true;
        });

        var thePost = $('.the-post');
        var socialButtons = $('.share-links');
        var socialButtonsBuffer = 0;
        if(thePost){
            $(window).resize(onResize);
            onResize();
        }
        function onResize(){
            socialButtonsBuffer = (window.innerWidth - thePost.outerWidth() - 74) / 4; //74 is button width 2 sides and half of each of the sides
            socialButtons.css({paddingLeft:socialButtonsBuffer, paddingRight:socialButtonsBuffer});
        }

        setInterval(function() {
            if (didScroll) {
                hasScrolled();
                didScroll = false;
            }
        }, 250);

        hasScrolled();

        $('.navbar-toggle').on('click', function (event) {
            event.preventDefault();
            $('.navbar-collapse.collapse').slideToggle();//.addClass('mobile-nav-is-on');
        });

        $('.close-nav-button').on('click', function (event) {
            event.preventDefault();
            $('body').removeClass('mobile-nav-is-on');
        });

        $('.share-links').affix({
            offset: {
                top: function () {
                    return (this.top = $('.featured-image').outerHeight(true) + $('.navbar').outerHeight(true))
                },
                bottom: 700
            }
        });

        $('body').removeClass('site-loading').addClass('site-loaded');
    });

    function hasScrolled() {
        st = $(document).scrollTop();
        if(Math.abs(lastScrollTop - st) <= delta){
            return;
        }
        if (st > lastScrollTop && st > navbarHeight){
            // Scroll Down
            //header.removeClass('taller');//.addClass('nav-up');
           // $('.share-links').addClass('sticky');
            header.addClass('border-bottom');
        } else {
            // Scroll Up
            if(st + $(window).height() < $(document).height()) {
                //header.addClass('taller');
                //$('.share-links').removeClass('sticky');
                header.removeClass('border-bottom');
            }
        }
        if(st === 0){
            //header.addClass('taller');
            header.removeClass('border-bottom');
        }
        lastScrollTop = st;
    }
})(jQuery);

/*!
 * Bootstrap v3.3.7 (http://getbootstrap.com)
 * Copyright 2011-2017 Twitter, Inc.
 * Licensed under MIT (https://github.com/twbs/bootstrap/blob/master/LICENSE)
 */

/*!
 * Generated using the Bootstrap Customizer (http://getbootstrap.com/customize/?id=a80a8bccbe1a6c0c35e65f73d60a7600)
 * Config saved to config.json and https://gist.github.com/a80a8bccbe1a6c0c35e65f73d60a7600
 */
if (typeof jQuery === 'undefined') {
    throw new Error('Bootstrap\'s JavaScript requires jQuery')
}
+function ($) {
    'use strict';
    var version = $.fn.jquery.split(' ')[0].split('.')
    if ((version[0] < 2 && version[1] < 9) || (version[0] == 1 && version[1] == 9 && version[2] < 1) || (version[0] > 3)) {
        throw new Error('Bootstrap\'s JavaScript requires jQuery version 1.9.1 or higher, but lower than version 4')
    }
}(jQuery);

/* ========================================================================
 * Bootstrap: affix.js v3.3.7
 * http://getbootstrap.com/javascript/#affix
 * ========================================================================
 * Copyright 2011-2016 Twitter, Inc.
 * Licensed under MIT (https://github.com/twbs/bootstrap/blob/master/LICENSE)
 * ======================================================================== */

+function ($) {
    'use strict';

    // AFFIX CLASS DEFINITION
    // ======================

    var Affix = function (element, options) {
        this.options = $.extend({}, Affix.DEFAULTS, options)

        this.$target = $(this.options.target)
            .on('scroll.bs.affix.data-api', $.proxy(this.checkPosition, this))
            .on('click.bs.affix.data-api',  $.proxy(this.checkPositionWithEventLoop, this))

        this.$element     = $(element)
        this.affixed      = null
        this.unpin        = null
        this.pinnedOffset = null

        this.checkPosition()
    }

    Affix.VERSION  = '3.3.7'

    Affix.RESET    = 'affix affix-top affix-bottom'

    Affix.DEFAULTS = {
        offset: 0,
        target: window
    }

    Affix.prototype.getState = function (scrollHeight, height, offsetTop, offsetBottom) {
        var scrollTop    = this.$target.scrollTop()
        var position     = this.$element.offset()
        var targetHeight = this.$target.height()

        if (offsetTop != null && this.affixed == 'top') return scrollTop < offsetTop ? 'top' : false

        if (this.affixed == 'bottom') {
            if (offsetTop != null) return (scrollTop + this.unpin <= position.top) ? false : 'bottom'
            return (scrollTop + targetHeight <= scrollHeight - offsetBottom) ? false : 'bottom'
        }

        var initializing   = this.affixed == null
        var colliderTop    = initializing ? scrollTop : position.top
        var colliderHeight = initializing ? targetHeight : height

        if (offsetTop != null && scrollTop <= offsetTop) return 'top'
        if (offsetBottom != null && (colliderTop + colliderHeight >= scrollHeight - offsetBottom)) return 'bottom'

        return false
    }

    Affix.prototype.getPinnedOffset = function () {
        if (this.pinnedOffset) return this.pinnedOffset
        this.$element.removeClass(Affix.RESET).addClass('affix')
        var scrollTop = this.$target.scrollTop()
        var position  = this.$element.offset()
        return (this.pinnedOffset = position.top - scrollTop)
    }

    Affix.prototype.checkPositionWithEventLoop = function () {
        setTimeout($.proxy(this.checkPosition, this), 1)
    }

    Affix.prototype.checkPosition = function () {
        if (!this.$element.is(':visible')) return

        var height       = this.$element.height()
        var offset       = this.options.offset
        var offsetTop    = offset.top
        var offsetBottom = offset.bottom
        var scrollHeight = Math.max($(document).height(), $(document.body).height())

        if (typeof offset != 'object')         offsetBottom = offsetTop = offset
        if (typeof offsetTop == 'function')    offsetTop    = offset.top(this.$element)
        if (typeof offsetBottom == 'function') offsetBottom = offset.bottom(this.$element)

        var affix = this.getState(scrollHeight, height, offsetTop, offsetBottom)

        if (this.affixed != affix) {
            if (this.unpin != null) this.$element.css('top', '')

            var affixType = 'affix' + (affix ? '-' + affix : '')
            var e         = $.Event(affixType + '.bs.affix')

            this.$element.trigger(e)

            if (e.isDefaultPrevented()) return

            this.affixed = affix
            this.unpin = affix == 'bottom' ? this.getPinnedOffset() : null

            this.$element
                .removeClass(Affix.RESET)
                .addClass(affixType)
                .trigger(affixType.replace('affix', 'affixed') + '.bs.affix')
        }

        if (affix == 'bottom') {
            this.$element.offset({
                top: scrollHeight - height - offsetBottom
            })
        }
    }


    // AFFIX PLUGIN DEFINITION
    // =======================

    function Plugin(option) {
        return this.each(function () {
            var $this   = $(this)
            var data    = $this.data('bs.affix')
            var options = typeof option == 'object' && option

            if (!data) $this.data('bs.affix', (data = new Affix(this, options)))
            if (typeof option == 'string') data[option]()
        })
    }

    var old = $.fn.affix

    $.fn.affix             = Plugin
    $.fn.affix.Constructor = Affix


    // AFFIX NO CONFLICT
    // =================

    $.fn.affix.noConflict = function () {
        $.fn.affix = old
        return this
    }


    // AFFIX DATA-API
    // ==============

    $(window).on('load', function () {
        $('[data-spy="affix"]').each(function () {
            var $spy = $(this)
            var data = $spy.data()

            data.offset = data.offset || {}

            if (data.offsetBottom != null) data.offset.bottom = data.offsetBottom
            if (data.offsetTop    != null) data.offset.top    = data.offsetTop

            Plugin.call($spy, data)
        })
    })

}(jQuery);
