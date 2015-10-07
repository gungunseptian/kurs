<?php

namespace App\Library;

use Goutte\Client;
use App\Helper\DateHelper;

class Scrapper {

  protected $url;
  protected $params;
  protected $headers;
  protected $options;
  protected $client;
  protected $xpath;
  protected $getValue;
  protected $nodeResp = [];
  protected $date;

  public function __construct(){
    $this->client = new Client();
    $this->date   = new DateHelper();
  }


  public function action($paramsSearch){

    $crawler  = $this->client->request('GET', $this->url);

    switch ($paramsSearch['bankCode']) {
      case 'BI':
        // get date
        $crawler->filterXPath('//*[@id="ctl00_PlaceHolderMain_biWebKursTransaksiBI_lblUpdate"]')->each(function ($node) {
          $this->dateUpdate = $node->text();
        });

        $expDate = explode(' ',$this->dateUpdate);
        $newDate = $expDate[2].'-'.date('m',strtotime($this->date->monthIndoToEng($expDate[1]))).'-'.$expDate[0];
        $newDateRate = date('Y-m-d',strtotime($newDate));

        $form     = $crawler->selectButton('Lihat')->form();
        $crawler  = $this->client->submit($form, $this->params);
        break;

      default:
        # code...
        break;
    }



    $response = [];
    foreach ($this->xpath as $key => $value) {
      $this->getValue ='';
      $crawler->filterXPath($value)->each(function ($node) {
        $this->getValue[]= str_replace(' ','',$node->text());
      });
      $response[$key]=$this->getValue;
    }



    $i=0;
    $parsing=[];
    foreach ($response['currency'] as $key => $value) {
      $parsing[]=array('currency_code'=>$response['currency'][$i],
                        'rate_sell'=>str_replace(',','',$response['rate_sell'][$i]),
                        'rate_buy'=>str_replace(',','',$response['rate_buy'][$i]),
                        'rate_date'=>$newDateRate,//$this->params[''],
                        'bank_code'=>$paramsSearch['bankCode'],
                        'created_at'=>date('Y-m-d')
                );
      $i++;
    }

    return $parsing;
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
