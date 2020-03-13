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
