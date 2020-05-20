<?php

// Load gpu type
if (isset($_GET['load'])) {
	$load_url = $_GET['load'];
    $load_url = htmlspecialchars(substr($load_url, 0, 55)); // limit url to 55 characters
	$evga_url = '&family='.$load_url;
	$load_url = str_replace('+', "%2B", $load_url);
} else {
	$load_url = '';
	$evga_url = '';
}

// Loads all gpus, but default searches for value
if (isset($_GET['search']))
	$search_gpu = htmlspecialchars($_GET['search']);
else
	$search_gpu = '';

// Only loads gpus with the exact phrase specified
if (isset($_GET['exact']))
	$exact_gpu = htmlspecialchars($_GET['exact']);
else
	$exact_gpu = '';

if (isset($_GET['ui']))
	$showui = htmlspecialchars($_GET['ui']);
else
	$showui = true;

if (isset($_GET['plaintext']))
	$plaintext = htmlspecialchars($_GET['plaintext']);
else
	$plaintext = false;

// Evga b stock url
$evga_url = "http://www.evga.com/Products/ProductList.aspx?type=8" . $evga_url;

// curlelelele
$curl = curl_init();
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
curl_setopt($curl, CURLOPT_HEADER, false);
curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($curl, CURLOPT_URL, $evga_url);
curl_setopt($curl, CURLOPT_REFERER, $evga_url);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
$evga_content = curl_exec($curl);
curl_close($curl);

$DOM = new simple_html_dom();
$DOM->load($evga_content);

// Base url of page for navigation
$base_url = '//'.$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF']);

// Load gpus into array
function getProducts(simple_html_dom $DOM, $exact_gpu) {
	$product = array();
	$items = $DOM->getElementById('LFrame_prdList_rlvProdList_ctrl0_pnlGroupContainer');
	if (empty($items)) {
		echo '<h1 style="color:#fff;padding:64px 0;">EVGA Down for maintenance or experiencing technical difficulties</h1>';
		return false;
	}
    foreach($items->find('div.list-item') as $td) {
        $title = $td->find('span.pl-list-pname');
        $title = checkSet($title);

        if ($exact_gpu !== '') // Only add gpu listing to the array which contain $exact_gpu
        	if (stristr($title, $exact_gpu) !== false) { } else { continue; }

        $GPUlink = $title->href;
        $title->href = 'http://www.evga.com'.$GPUlink;
        $title->style = '';

        $img = $td->find('img');
        $img = checkSet($img);
        $imgsrc = $img->src;

        $part = $td->find('p.pl-list-pn');
        $part = checkSet($part);
        $part = str_replace('Part Number: ', '', $part);

        $desc = $td->find('div.pl-list-info ul');
        $desc = checkSet($desc);

        $price = $td->find('p.pl-list-price');
        $price = checkSet($price);

        $sale = $td->find('.btnAddCart');
        if (isset($sale[0]))
        	$sale = '<a href="http://www.evga.com'.$GPUlink.'" class="btn btn-success">In Stock</a>';
        else
        	$sale = '<a href="#" class="btn btn-default" disabled="disabled">OOS</a>';
        
        $product[$part] = array(
        	'title' => trim($title),
        	'img' => trim($imgsrc),
        	'part' => preg_replace('/\s+/', ' ', $part),
        	'desc' => preg_replace('/\s+/', ' ', $desc),
        	'price' => preg_replace('/\s+/', ' ', $price),
        	'sale' => trim($sale)
        );
        unset($GPUlink);
        unset($imgsrc);
    }
    return $product;
}

function getNavigation(simple_html_dom $DOM) {
	$navbar = array();
	$navigation = $DOM->getElementById('prdMenu_RadMenu');
	if (empty($navigation))
		return false;
	foreach($navigation->find('li[class=rmItem rmLast] > div.rmSlide > ul.rmLevel1', 0)->children() as $navlist) {
		$navlink = $navlist->find('a', 0);
		$navtitle = $navlink->title;
		$navtitle = str_replace("GeForce", "", $navtitle);
		$navurl = $navlink->href;
		$navurl = str_replace("ProductList.aspx?type=8&amp;family=", "", $navurl);
		$navurl = str_replace('+', "%2B", $navurl);

		//$navitem = $navitem->title;
		$navbar[$navtitle] = array (
			'url' => $navurl
		);
	}
	return $navbar;
}

// Check if variable isset
function checkSet($checkVar) {
	if (isset($checkVar[0]))
    	$checkVar = $checkVar[0];
    else
    	$checkVar = '';
    return $checkVar;
}