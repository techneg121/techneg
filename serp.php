<?php
if (isset($_POST["domain"]) && isset($_POST["query"])){


	$GOOGLE_API_KEY = '428804900932-i301i85kb8j84shc8rf7q8jqc7ne9duj.apps.googleusercontent.com';
	$GOOGLE_CSE_CX = '54a545a78b8d1a7f9';


	$query = urlencode($_POST["query"]);
	$domain = $_POST["domain"];

	//gl - google host - https://developers.google.com/custom-search/docs/xml_results_appendices#countryCodes
	//hl - user language - https://developers.google.com/custom-search/docs/xml_results_appendices#interfaceLanguages
	//pages - how many pages should the search extend


	$pages = isset($_POST["pages"])?$_POST["pages"]:1;
	$gl = isset($_POST["gl"])?$_POST["gl"]:"us";
	$hl = isset($_POST["hl"])?$_POST["hl"]:"en";



	$found = false;
	echo "<ul>";
	for ($page = 1;$page <= $pages && $found == false;$page++){
		$apiurl = sprintf('https://www.googleapis.com/customsearch/v1?q=%s&cx=%s&key=%s&hl=%s&gl=%s&start=%d',$query,$GOOGLE_CSE_CX,$GOOGLE_API_KEY,$hl,$gl,($page-1)*10+1);
		// echo $apiurl;
		$json = file_get_contents($apiurl);
		// $json = file_get_contents('http://localhost/wordpress/serp-checker/test.json');
		$obj = json_decode($json);

		
		foreach ($obj->items as $idx=>$item) {
			if (strpos($item->link, $domain) ){
				$found = true;
				echo "<li>";
			} else{
				echo "<li class='other'>";
			}
				echo "<span class='rank'>".($idx + ($page-1)*10 +1)."</span>";
				echo "<span class='title'>".$item->htmlTitle."</span>";
				echo "<span class='link'>".$item->link."<small>&#x25BC;</small></span>";
				echo "<span class='snippet'>".$item->htmlSnippet."</span>";
				echo "</li>";
			
		}
	}
	if ($found !== true){
		echo "<li>";
			echo "<span class='title'>".$domain." not found</span>";
		echo "</li>";
	}
	echo "</ul>";

}
?>
