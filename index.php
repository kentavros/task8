<?php
include ('libs/SearchClass.php');


$page = new SearchClass();
//echo $page->getWebPage();
//file_put_contents('file', $page->getWebPage());


//
//if (isset($_POST['search']))
//{
//    $search = $page->replacePost();
//    $page->getWebPage($search);
//    $page->toFile();
//}


include ('template/tmp.php');
?>