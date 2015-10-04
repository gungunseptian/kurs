<?php

namespace App\Library;

use Goutte\Client;

class Scrapper {

  protected $url;
  protected $params;
  protected $headers;
  protected $options;
  protected $client;
  protected $xpath;
  protected $getValue;
  protected $nodeResp = [];

  public function __construct(){
    $this->client = new Client();
  }


  public function action($bank){

    switch ($bank) {
      case 'BI':
            $crawler = $this->client->request('GET', $this->url);
            $form = $crawler->selectButton('Lihat')->form();
            $crawler = $this->client->submit($form, $this->params);
            $response = [];
            foreach ($this->xpath as $key => $value) {
              $this->getValue ='';
              $crawler->filterXPath($value)->each(function ($node) {
                $this->getValue[]= str_replace(' ','',$node->text());
              });
              $response[$key]=$this->getValue;
            }

            $i=0;
            foreach ($response['currency'] as $key => $value) {
              # code...
              $arr[]=array('currency'=>$response['currency'][$i],
                          'rate_sell'=>$response['rate_sell'][$i],
                          'rate_buy'=>$response['rate_buy'][$i]
                        );
              $i++;
            }

        break;

      default:
        # code...
        break;
    }

    dd($arr);

    return $response;
  }

  public function setUrl($url){
    return $this->url = $url;
  }

  public function setHeaders($headers=array()){
    return $this->headers = $headers;
  }

  public function setOptions($options=array()){
    return $this->options = $options;
  }

  public function setParams($params=array()){
    return $this->params = $params;
  }

  public function setXpath($xpath){
    return $this->xpath = $xpath;
  }

}


?>
