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
        <style>
        	.priceFinal, .partNumber {
        		margin: 0 !important;
        	}
        </style>
    </head>
    <body>
      <?php $product = getProducts($DOM, $exact_gpu); $i = 0; if ($product !== false) : foreach ($product as $gpu) : ?>
	      	<ul>
	      		<li><?=$gpu['title'];?></li>
	      		<ul>
	      			<li><?=$gpu['part'];?></li>
	      			<li><?=$gpu['price'];?></li>
	      			<li><?=$gpu['sale'];?></li>
	      		</ul>
	      		<?=$gpu['desc'];?>
	      	</ul>
      <?php $i++; endforeach; endif; ?>

	</body>
	</html>
	<?php
		die;