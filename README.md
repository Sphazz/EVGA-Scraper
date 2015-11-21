# EVGA-Scraper
Scraper for EVGA B-Stock Website written in PHP with Simple HTML DOM Parser
<p>Arguements: <code>?argument=value&argumenttwo=valuetwo&...etc</code></p>
<strong>load:</strong> Only accepts valid EVGA urls
<ul>
	<li>Loads a GPU family</li>
	<li>Used for navigation between categories</li>
	<li>Appended to EVGA's site url</li>
</ul>
</ul>
<strong>search:</strong> *
<ul>
	<li>Preloads search field with value</li>
	<li>Still loads rest of GPU listing</li>
</ul>
<strong>exact:</strong> *
<ul>
	<li>Only displays gpus which contain the term stored in argument</li>
	<li>Does not load other gpus</li>
</ul>
<strong>ui:</strong> bool, true or false
<ul>
	<li>Whether or not to load navigation ui</li>
	<li>Default true</li>
</ul>
<strong>plaintext:</strong> bool, true or false
<ul>
	<li>Whether or not to load webpage in plain text to converse bandwidth</li>
	<li>Default false</li>
</ul>
