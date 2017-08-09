<?php
include ('libs/SearchClass.php');


$page = new SearchClass();
$page->getWebPage();
echo "<br>";
$page->parsingHtml();
    
//$page->getWebPage();
//file_put_contents('file', $page->getWebPage());
//var_dump($page->getWebPage());

//
//if (isset($_POST['search']))
//{
//    $search = $page->replacePost();
//    $page->getWebPage($search);
//    $page->toFile();
//}


include ('template/tmp.php');
?>
