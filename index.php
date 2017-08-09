<?php
include ('libs/SearchClass.php');


$page = new SearchClass();

if (isset($_POST['search']))
{
   
    
    $page->getWebPage($page->replacePost());
    $arr = $page->parsingHtml();
     

}






    




 







include ('template/tmp.php');
?>
