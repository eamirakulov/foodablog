<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<head>
    <!-- Google Tag Manager -->
    <noscript><iframe src="//www.googletagmanager.com/ns.html?id=GTM-5ZWML2" height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
    <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src='//www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);})(window,document,'script','dataLayer','GTM-5ZWML2');</script>
    <!-- End Google Tag Manager -->
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="format-detection" content="telephone=no">
	<?php wp_head(); ?>
    <style>body {opacity:0}</style>
    <script
  src="https://code.jquery.com/jquery-3.4.1.min.js"
  integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
  crossorigin="anonymous"></script>
  <script
  src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"
  integrity="sha256-VazP97ZCwtekAsvgPBSUwPFKdrwD3unUfSGVYrahUqU="
  crossorigin="anonymous"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/js-cookie/2.2.1/js.cookie.js"></script>
    <script src="https://cdn.rawgit.com/google/code-prettify/master/loader/run_prettify.js"></script>
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
    <script src="https://use.typekit.net/ozn4gku.js"></script>
    <script>try{Typekit.load({ async: true });}catch(e){}</script>

    <link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/css/normalize.css">
    <link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/style.css">
</head>
<body <?php body_class(array('app-loading')); ?>>

<style>
.navbar.taller #logo img { margin-top: 24px; }
/* ========================================= */
/* navbar */
.navbar {
  background: white;
  border: none;
  border-bottom: 1px solid #e0e0e0;
  margin-bottom: 0;
}
body.admin-bar .navbar { top: 32px !important; }
.navbar a:hover { color: #2a6496; text-decoration: underline !important; }
.navbar.taller .navbar-nav > li > a {
  padding-top: 29px;
  padding-bottom: 30px;
}
.navbar.taller .navbar-toggle { margin-top: 22px; margin-bottom: 23px; }
.navbar.animated .navbar-header *,
.navbar.animated .navbar-nav > li.tall-padded,
.navbar.animated .navbar-nav > li > a {
  -webkit-transition: padding 0.2s;
  transition: padding 0.2s;
}
.navbar.animated #logo img,
.navbar.taller .navbar-toggle {
  -webkit-transition: margin 0.2s;
  transition: margin 0.2s;
}
/*.navbar.taller li.tall-padded { padding-top: 14px; }*/
.navbar .btn-blueberry { margin-top: 0px; border-radius: 3px; border: none !important }
.navbar a.btn-blueberry:hover { text-decoration: none !important; }
.navbar-nav > li > a { padding-left: 12px; padding-right: 12px; }

.btn-blueberry:hover { background-color: #659DE3 !important }

.navbar li.dropdown:hover {
  background: #f5f5f5;
}
.navbar li:hover > a:hover {
  text-decoration: none !important;
}
.navbar li.tall-padded:hover { background: none; }
.navbar .dropdown:hover .dropdown-menu {
  display: block;
  margin-top: 0;
}
.dropdown-menu li a {
	padding: 0.4em 1.5em;
}
.dropdown-menu li.no-link {
	padding: 0.4em 1.5em;
	color: #ccc;
	text-transform: uppercase;
}
@media screen and (max-width: 1060px) {
	/* Updates to collapse navbar at 992 instead of 768 to accommodate more items in the nav */
  .navbar-header {
		float: none;
  }
  .navbar-left,.navbar-right {
		float: none !important;
  }
  .navbar-toggle {
		display: block;
  }
  .navbar-collapse {
		border-top: 1px solid transparent;
		box-shadow: inset 0 1px 0 rgba(255,255,255,0.1);
  }
  .navbar-fixed-top {
		top: 0;
		border-width: 0 0 1px;
	}
  .navbar-collapse.collapse {
		display: none;
  }
  .navbar-nav {
		float: none!important;
		margin-top: 7.5px;
	}
	.navbar-nav>li {
		float: none;
  }
  .navbar-nav>li>a {
		padding-top: 10px;
		padding-bottom: 10px;
  }
  .collapse.in{
		display:block !important;
	}

	ul.navbar-right {
		margin-top: 1em;
		border-top: 1px solid #f8f6f4;
		padding-top: 1em;
	}

	/* Also the button style changes at this breakpoint */
  .navbar-fixed-top ul.navbar-nav.navbar-right .btn-blueberry,
  .navbar-fixed-top ul.navbar-nav.navbar-right .btn-blueberry:focus,
  .navbar-fixed-top ul.navbar-nav.navbar-right .btn-blueberry:hover {
    color: #777 !important;
    padding: 7px 12px 7px 12px !important;
    text-align: left;
    margin: 0;
    background-color: transparent !important;
    border: none;
    font-weight: 300;
    text-transform: none;
    font-size: 1em;
  }
  .navbar-fixed-top ul.navbar-nav.navbar-right .btn-blueberry:focus,
  .navbar-fixed-top ul.navbar-nav.navbar-right .btn-blueberry:hover {
    text-decoration: underline !important; color: #333 !important;
  }
}

@media only screen and (min-width: 1041px) {
  .navbar-margin {
    margin:0px 20px 0px 20px;
  }
}
@media screen and (max-width: 1200px) {
  .navbar-margin {
    margin-left: 20px;
  }
}

</style>

<?php
    echo Assets::get_fooda_header_and_footer('header');
?>
