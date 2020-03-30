function setCookie(name,value,days) {
    var expires = "";
    if (days) {
        var date = new Date();
        date.setTime(date.getTime() + (days*24*60*60*1000));
        expires = "; expires=" + date.toUTCString();
    }
    document.cookie = name + "=" + (value || "")  + expires + "; path=/";
}
function getCookie(name) {
    var nameEQ = name + "=";
    var ca = document.cookie.split(';');
    for(var i=0;i < ca.length;i++) {
        var c = ca[i];
        while (c.charAt(0)==' ') c = c.substring(1,c.length);
        if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length,c.length);
    }
    return null;
}

$(function() {
	$('.toggle-filter').click(function() {
		$('.filter-box').fadeIn();
	});

	$('.close-filter').click(function() {
		$('.filter-box').fadeOut();
	});

	$('.toggle-search').click(function() {
		$('#searchform').addClass('vis');
		$('.fa-search').addClass('active');
	});

	$('.fa-search .active').click(function() {
		$('#search-form').submit();
	});

	if($(window).width() < 768) {}
		// slideOut CTA
		var ctaDelay = $('.slide-out-cta').data('delay') * 1000;
		if (getCookie('slide-out-cta') == null) {
			setCookie('slide-out-cta');
			$('.fade-area').hide().delay(ctaDelay).fadeIn();
			$('.slide-out-cta').delay(ctaDelay).toggle( "slide" );
		}

		$('.close-cta, .button-alt').click(function(e) {
			e.preventDefault();
			$('.slide-out-cta').toggle( "slide" );
			$('.fade-area').hide().delay(ctaDelay).fadeOut();
		});

		// lightbox CTA
		var ctaDelay = $('.lightbox-cta').data('delay') * 1000;
		
		if (getCookie('lightbox-cta') == null) {
			setCookie('lightbox-cta');
			$('.lightbox-cta').hide().delay(ctaDelay).css("display", "flex")
		    .hide()
		    .fadeIn();
		}
		$('.lightbox-cta form').submit(function(e) {
			$('.lightbox-cta').fadeOut();
		});
		$('.close-cta').click(function(e) {
			e.preventDefault();
			$('.lightbox-cta').fadeOut();
		});
	}
});