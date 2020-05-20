<?php include_once __DIR__.'/php/simple_html_dom.php'; include_once __DIR__.'/php/evga_scraper.php'; if ($plaintext == true) { include_once __DIR__.'/php/plaintext.php'; } ?><!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang=""> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>EVGA B-Stock</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="theme-color" content="#2E7D32">
        <link rel="apple-touch-icon" href="apple-touch-icon.png">

        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,600,400italic,700,600italic' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" type="text/css" href="css/main.css">
        <style>
        	
        </style>

        <script src="js/vendor/modernizr-2.8.3-respond-1.4.2.min.js"></script>
    </head>
    <body>
        <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
    <nav id="nav" class="navbar navbar-side navbar-fixed-top" role="navigation">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
        </div>
        <div id="navbar" class="collapse navbar-collapse navbar-ex1-collapse">
            <a class="navbar-brand" href="http://www.evga.com/Products/ProductList.aspx?type=8">EVGA B-Stock</a>
            <ul class="nav navbar-nav">
                <li><a href="http:<?=$base_url;?>/index.php?load=">All</a></li>
                <?php $nav = getNavigation($DOM); if ($nav !== false && $showui === true) : foreach ($nav as $navname => $navitem) : ?>
                    <li><a href="http:<?=$base_url . '/index.php?load=' . $navitem['url'];?>"><?=$navname;?></a></li>
                <?php endforeach; endif; ?>

            </ul>
        </div><!--/.navbar-collapse -->
    </nav>
    <nav id="nav-top" class="navbar navbar-fixed-top" role="navigation">
      <div class="container">
        <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav navbar-left">
                <li><a href="http:<?=$base_url;?>/index.php?plaintext=true<?php if($load_url !== '') : ?>&amp;load=<?=htmlentities($load_url);endif;?><?php if($exact_gpu !== '') : ?>&amp;exact=<?=$exact_gpu;endif;?>">Text Mode</a></li>
                <!--<li><a href="http:<?=$base_url;?>/index.php?ui=<?php /*if ($showui == false) { echo 'true'; } else { echo 'false'; } */?>">Toggle UI</a></li>-->
            </ul>
            <form class="navbar-form navbar-right" role="search">
                <div class="form-group">
                    <input type="text" id="filter-search" class="form-control" placeholder="Search">
                </div>
            </form>
        </div>
      </div>
    </nav>
    <div id="main" class="container">
	<br>

<?php $product = getProducts($DOM, $exact_gpu); $i = 0; if ($product !== false) : foreach ($product as $gpu) : ?><div class="gpu-listing col-lg-4 col-md-6 col-sm-6 col-xs-12"> <div class="panel panel-mat"><div class="panel-heading"> <h3 class="panel-title"><?=$gpu['title'];?></h3> <span class="paragraph-end"></span> </div> <div class="panel-body"> <div class="row"> <div class="gpu-img-container col-xs-5"> <img src="<?=$gpu['img'];?>" class="gpu-img" /> </div> <div class="gpu-info-container col-xs-7"> <?=$gpu['part'];?> <?=$gpu['desc'];?> <div class="row price-stock"> <div class="col-xs-6"> <?=$gpu['price'];?> </div> <div class="col-xs-6" style="text-align:right;"> <?=$gpu['sale'];?> </div> </div> </div> </div> </div> </div> </div><?php $i++; endforeach; endif; ?>

    </div> <!-- /container --> 
	<footer>
		<div class="container">
		<p style="color:#fff;padding:12px 0;margin: 0;">All images and products are copyright of EVGA and nVidia</p>
	</div>
	</footer>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="js/vendor/jquery-1.11.2.min.js"><\/script>')</script>

        <script src="js/vendor/bootstrap.min.js"></script>
        <script src="js/main.js"></script>

        <!-- Google Analytics: change UA-XXXXX-X to be your site's ID. 
        <script>
            (function(b,o,i,l,e,r){b.GoogleAnalyticsObject=l;b[l]||(b[l]=
            function(){(b[l].q=b[l].q||[]).push(arguments)});b[l].l=+new Date;
            e=o.createElement(i);r=o.getElementsByTagName(i)[0];
            e.src='//www.google-analytics.com/analytics.js';
            r.parentNode.insertBefore(e,r)}(window,document,'script','ga'));
            ga('create','UA-XXXXX-X','auto');ga('send','pageview');
        </script>-->
    </body>
</html>
