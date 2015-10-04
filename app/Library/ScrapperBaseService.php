<?php

namespace App\Library;


class ScrapperBaseService {

  protected $url;
  protected $params;
  protected $headers;
  protected $options;

  public function post(){

  }

  public function get(){

  }

  public function setUrl($url){
    $this->url = $url;
  }

  public function setHeaders($headers=array()){
    $this->headers = $headers;
  }

  public function setOptions($options=array()){
    $this->options = $options;
  }

}


?>
