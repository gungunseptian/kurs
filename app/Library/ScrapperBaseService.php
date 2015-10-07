<?php

namespace App\Library;
use App\Library\BankIndonesiaScrapper as BankIndonesia;
use App\Http\Models\KursModel;


class ScrapperBaseService {

  protected $params;

  public function execute($paramsSearch){
    switch ($paramsSearch['bankCode']) {
      case 'BI':
            // bank indonesia scrapper
            $bankIndonesia = new BankIndonesia;
            $response = $bankIndonesia->scrape($paramsSearch);

        break;

      default:
        return false;
        break;
    }

    if($response){
      $this->insertRate($response);
      return $response;
    }

    return false;
  }

  private function insertRate($response){
      if(KursModel::where('rate_date',$response[0]['rate_date'])->count()== 0){
          if(KursModel::insert($response)){
            return true;
          }
      }else{
           KursModel::where('rate_date',$response[0]['rate_date'])->update(array('created_at'=>date('Y-m-d')));
      }

      return false;
  }


}


?>
