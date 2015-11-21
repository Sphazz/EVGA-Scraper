<?php
	/*$url = "http://www.evga.com/Products/ProductList.aspx?type=8";
	$curl = curl_init($url);
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
	$output = curl_exec($curl);
	curl_close($curl);
	libxml_use_internal_errors(true);
	$DOM = new DOMDocument;
	$DOM->loadHTML($output);

	//get all H1
	$items = $DOM->getElementById('ctl00_LFrame_prdList_pnlGridView');
	$items = $items->getElementsByTagName('td');
	$items = $items->getElementsByTagName('td');*/

	include_once __DIR__.'/simple_html_dom.php';
	define('COOKIE_FILE', __DIR__.'/cookie.txt');
	@unlink(COOKIE_FILE); //clear cookies before we start

	define('CURL_LOG_FILE', __DIR__.'/request.txt');
	@unlink(CURL_LOG_FILE);//clear curl log
	class ASPBrowser {
	    public $exclude = array();
	    public $lastUrl = '';
	    public $dom = false;
	    /**Get simplehtmldom object from url
	     * @param $url
	     * @param $post
	     * @return bool|simple_html_dom
	     */
	    public function getDom($url, $post = false) {
	        $f = fopen(CURL_LOG_FILE, 'a+'); // curl session log file
	        if($this->lastUrl) $header[] = "Referer: {$this->lastUrl}";
	        $curlOptions = array(
	            CURLOPT_ENCODING => 'gzip,deflate',
	            CURLOPT_AUTOREFERER => 1,
	            CURLOPT_CONNECTTIMEOUT => 120, // timeout on connect
	            CURLOPT_TIMEOUT => 120, // timeout on response
	            CURLOPT_URL => $url,
	            CURLOPT_SSL_VERIFYPEER => false,
	            CURLOPT_SSL_VERIFYHOST => false,
	            CURLOPT_FOLLOWLOCATION => true,
	            CURLOPT_MAXREDIRS => 9,
	            CURLOPT_RETURNTRANSFER => 1,
	            CURLOPT_HEADER => 0,
	            CURLOPT_USERAGENT => "Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.95 Safari/537.36",
	            CURLOPT_COOKIEFILE => COOKIE_FILE,
	            CURLOPT_COOKIEJAR => COOKIE_FILE,
	            CURLOPT_STDERR => $f, // log session
	            CURLOPT_VERBOSE => true,
	        );
	        if($post) { // add post options
	            $curlOptions[CURLOPT_POSTFIELDS] = $post;
	            $curlOptions[CURLOPT_POST] = true;
	        }

	        $curl = curl_init();
	        curl_setopt_array($curl, $curlOptions);
	        $data = curl_exec($curl);
	        $this->lastUrl = curl_getinfo($curl, CURLINFO_EFFECTIVE_URL); // get url we've been redirected to
	        curl_close($curl);

	        if($this->dom) {
	            $this->dom->clear();
	            $this->dom = false;
	        }
	        $dom = $this->dom = str_get_html($data);

	        fwrite($f, "{$post}\n\n");
	        fwrite($f, "-----------------------------------------------------------\n\n");
	        fclose($f);

	        return $dom;
	    }

	    function createASPPostParams($dom, array $params) {
	        $postData = $dom->find('input,select,textarea');
	        $postFields = array();
	        foreach($postData as $d) {
	            $name = $d->name;
	            if(trim($name) == '' || in_array($name, $this->exclude)) continue;
	            $value = isset($params[$name]) ? $params[$name] : $d->value;
	            $postFields[] = rawurlencode($name).'='.rawurlencode($value);
	        }
	        $postFields = implode('&', $postFields);
	        return $postFields;
	    }

	    function doPostRequest($url, array $params) {
	        //$post = $this->createASPPostParams($this->dom, $params);
	        $post = false;
	        return $this->getDom($url, $post);
	    }

	    function doPostBack($url, $eventTarget, $eventArgument = '') {
	        return $this->doPostRequest($url, array(
	            '__EVENTTARGET' => $eventTarget,
	            '__EVENTARGUMENT' => $eventArgument
	        ));
	    }

	    function doGetRequest($url) {
	        return $this->getDom($url);
	    }

	}

	    function removeSpaces($s) {
		    return trim(preg_replace('!\s+!', ' ', $s));
		}

		function printTableData(simple_html_dom $dom) {
			$items = $dom->getElementById('ctl00_LFrame_prdList_pnlGridView');
		    foreach($items->find('div.gridItem') as $td) {
		        $td = $td->find('a[title=View Details]');
		        //echo removeSpaces($td[0]->innertext.';'.$td[1]->innertext.';'.$td[2]->innertext.';');
		        //echo $td[3]->find('a', 0)->href.';';
		        //echo $td[4]->find('img', 0)->alt."\n";
		        if (isset($td[0]))
		        	echo $td[0].'<br>';
		    }
		}

		$url = 'http://www.evga.com/Products/ProductList.aspx?type=8';
		$browser = new ASPBrowser();
		$browser->exclude = array('ctl00$ContentPlaceHolder1$btnClear');
		$browser->doGetRequest($url); // get form
		$resultPage = $browser->doPostRequest($url, array('type' => '8')); // get 1st page of results
		//$browser->exclude = array('ctl00$ContentPlaceHolder1$btnClearInd', 'ctl00$ContentPlaceHolder1$ddlPageSize', 'ctl00$ContentPlaceHolder1$btnSearchInd');
		//for($i = 2; $i < 5; $i++) {     
		     //printTableData($resultPage);     
		     //$resultPage = $browser->doPostBack($browser->lastUrl, 'ctl00$ContentPlaceHolder1$gvResults', 'Page$'.$i);
		//}
		
		
		//$resultPage->clear();

?>


<!DOCTYPE html>
<html>
<head>
	<title>EVGA Test</title>
</head>
<body>
<?php
	printTableData($resultPage);
	$resultPage->clear();
	//display all H1 text
	 /*for ($i = 0; $i < $items->length; $i++)
	        echo $items->item($i)->nodeValue . "<br/>";
	      */?>
</body>
</html>