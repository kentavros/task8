<?php
include ('libs/SearchClass.php');


$page = new SearchClass();
//echo $page->getWebPage('cat+dog');


if (isset($_POST['search']))
{
    $search = $page->replacePost();
    $page->getWebPage($search);
    $page->parsingHtml();
}


include ('template/tmp.php');
?>