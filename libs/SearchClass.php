<?php
class SearchClass
{
    protected $pageProp;


    public function replacePost()
    {
        $repPost = str_replace(' ', '+', $_POST['search']);
        unset($_POST['search']);
        return $repPost;
    }


    public function getWebPage($search) //DOBAVIT PARAM!!!!!!!!
    {
        

        $headers = array(
            'authority:www.google.com.ua',
            'method:GET',
            'path:/',
            'scheme:https',
            'accept:text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,*/*;q=0.8',
            //'accept-encoding:gzip, deflate, sdch, br',
            'accept-language:ru,en-US;q=0.8,en;q=0.6',
            'cookie:SID=AgVGh_WKbCVPYy_-CQu6gaCNCtDgclf-0E4bxr48fmMjkd6DsN5yNTf1qs9FL5Wdkv-Hkg.; HSID=Ao2TFroderVMfTyKD; SSID=AzuTU7-bGMuPrxHfE; APISID=wi01_MmX8XQclv6p/AObe1f64O5QJycxB3; SAPISID=p0hgAEuDbVET2GBJ/AwObzl-L5oo5b0p__; GOOGLE_ABUSE_EXEMPTION=ID=a0e6ecc2604eaa99:TM=1502261564:C=r:IP=217.77.212.20-:S=APGng0v64Ss7BehDErgXgwsvAvKT2r6lWg; NID=109=el_zchjIc3Fd3jlSoxkJWex2Y-dJox2HAY1ILToz1hNfZpcvji_uoiKJz6TNB49M47eG1X6jm2-9LE7NM5WoNyDJgiMP23DWP_JR7dOAPKfA1aFa582GV30v5EW1-yPh4yS3WJCLjgIVpK0KdKRH6Q6GCcuXh5ZMgsT-j14W-4HggRHNCNKZ4mxK76_n_BJgTbZiJyoMRzf4Kg; DV=8_tkIewt6ZFP4NLZ04kQ98Fg7Xlc3NX5A5tTxX4YCQIAAMDORODQfnDhqwAAAPyR1smOmIEvUgAAAA',
            'upgrade-insecure-requests:1',
            'user-agent:Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/55.0.2883.75 Safari/537.36',
            'x-client-data:CIy2yQEIorbJAQjEtskBCPucygEIqZ3KAQ==',

        );

        $adress = 'https://www.google.com.ua/search?q='.$search;
//      $adress = 'http://search.meta.ua/search.asp?q=dog';
        $ch = curl_init($adress);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $page = curl_exec($ch);
        curl_close($ch);
        if ($page !== false)
        {
            $this->pageProp = $page;
            return true;
           
        }
        else
        {
            return false;
        }
    }

    public function parsingHtml()
    {    $this->pageProp;     
        $doc = new DOMDocument();
        @$doc->loadHTML($this->pageProp);
    
        $xpath = new DOMXPath($doc);
        $nodes = $xpath->query("//*[contains(@class, 'srg')]");
      //  var_dump($nodes->item(0)->firstChild->getAttribute('class'));
        $arrData = array();
        
        for($i=0; $i< $nodes->item(0)->childNodes->length; $i++) 
        {
          
         $arrData[$i] =[
        'name'=>$nodes->item(0)->childNodes->item($i)->firstChild->nextSibling->firstChild->firstChild->firstChild->nodeValue,
         'link'=>$nodes->item(0)->childNodes->item($i)->firstChild->nextSibling->firstChild->firstChild->firstChild->getAttribute('href'),
        'discrip'=>$nodes->item(0)->childNodes->item($i)->firstChild->nextSibling->firstChild->firstChild->nextSibling->firstChild->firstChild->nextSibling->nodeValue 
                ];
          
         
        }
          return $arrData;
   }

    public function toFile()
    {
        file_put_contents('file', $this->pageProp);
    }


}
