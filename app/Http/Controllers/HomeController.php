<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Library\ScrapperBaseService;
use App\Http\Models\KursModel;
use Theme;

class HomeController extends Controller
{

  /**
    * Theme instance.
    *
    * @var \Teepluss\Theme\Theme
    */
   protected $theme;
   protected $currency_code_hide;

   /**
    * Construct
    *
    * @return void
    */
   public function __construct(Theme $theme)
   {
       // Using theme as a global.
       $this->theme = Theme::uses('default')->layout('main');
       $this->currency_code_hide= ['BND','CAD','CHF','DKK','KRW','KWD','MYR','NOK','PGK','PHP','SAR','SEK','THB'];

    }


  function cron(){
      $scrape = new ScrapperBaseService;
    // $paramsSearch['from'] = '2015-09-01';
      //$paramsSearch['to'] = '2015-09-01';
      $paramsSearch['bankCode'] = 'BI';
      $result = $scrape->execute($paramsSearch);

     dd($result);
  }
  function index(){
      $currencyName = 'rupiah';
      $data['dataKurs']= KursModel::where('created_at',date('Y-m-d'))
                                    ->whereNotIn('kurs.currency_code',$this->currency_code_hide)
                                    ->join('currency', 'kurs.currency_code', '=', 'currency.currency_code')
                                    ->join('bank', 'kurs.bank_code', '=', 'bank.bank_code')
                                    ->orderBy('rate_date','desc')
                                    ->orderBy('kurs.currency_code','asc')->get();
      foreach($data['dataKurs'] as $key => $val){
        if($val['currency_code']=='USD'){
          $rate = $val['rate_sell'];
        }
      }

      $this->theme->setTitle('Kurs '.$currencyName.' Hari Ini - Dollar Rp.'.number_format($rate,2) );
      $this->theme->setKeyword('Kurs Rupiah, kurs hari ini, kurs rupiah hari ini, kurs dollar, kurs dollar hari ini');
      $this->theme->setDescription('Informasi kurs '.$currencyName.' hari ini - Dollar Rp.'.number_format($rate,2));

      $data['updatedDate'] = $data['dataKurs'][0]['created_at'];
      return $this->theme->scope('home', $data)->render();

    }

  function listByCurrencyToday($currencyName){

    $data['dataKurs']= KursModel::where('created_at',date('Y-m-d'))
                                  ->whereNotIn('kurs.currency_code',$this->currency_code_hide)
                                  ->join('currency', 'kurs.currency_code', '=', 'currency.currency_code')
                                  ->join('bank', 'kurs.bank_code', '=', 'bank.bank_code')
                                  ->where('currency_alias',str_slug($currencyName))->orderBy('rate_date','desc')->orderBy('kurs.currency_code','asc')->get();

    foreach ($data['dataKurs'] as $key => $value) {
          if($value['currency_alias']==str_slug($currencyName)){
                $rate = $value['rate_sell'];
                $this->theme->setTitle('Kurs '.ucfirst($currencyName).' Hari Ini - Rp.'.number_format($rate,2) );

          }else{
            $this->theme->setTitle('Kurs '.ucfirst($currencyName).' Hari Ini - Rp.'.number_format($rate,2) );
          }


    }




    $this->theme->setKeyword('kurs rupiah, kurs hari ini, kurs rupiah hari ini, kurs dollar, kurs dollar hari ini');
    $this->theme->setDescription('Informasi kurs '.$currencyName.' hari ini. dibuka pada Rp.'.number_format($rate,2));
    $data['updatedDate'] = $data['dataKurs'][0]['created_at'];
    return $this->theme->scope('home', $data)->render();
  }

  function listByCurrencyCompare($currencyName1,$currencyName2){

    $data['dataKurs']= KursModel::where('created_at',date('Y-m-d'))
                                  ->whereNotIn('kurs.currency_code',$this->currency_code_hide)
                                  ->join('currency', 'kurs.currency_code', '=', 'currency.currency_code')
                                  ->join('bank', 'kurs.bank_code', '=', 'bank.bank_code')
                                  //->where('currency_alias',str_slug($currencyName1))->orderBy('rate_date','desc')->orderBy('kurs.currency_code','asc')
                                  ->get();

    foreach ($data['dataKurs'] as $key => $value) {
          if($value['currency_alias']==str_slug('dollar')){
                $rate = $value['rate_sell'];
                $this->theme->setTitle('Kurs '.ucfirst($currencyName1).' '.ucfirst($currencyName2).' Hari Ini - Rp.'.number_format($rate,2) );

          }else{
            $rate = $value['rate_sell'];
            $this->theme->setTitle('Kurs '.ucfirst($currencyName1).' '.ucfirst($currencyName2).' Hari Ini - Rp.'.number_format($rate,2) );
          }


    }

    $this->theme->setKeyword('kurs dollar rupiah, kurs rupiah, kurs hari ini, kurs rupiah hari ini, kurs dollar, kurs dollar hari ini');
    $this->theme->setDescription('Informasi kurs '.ucfirst($currencyName1).' '.ucfirst($currencyName2).' hari ini. dibuka pada Rp.'.number_format($rate,2));
    $data['updatedDate'] = $data['dataKurs'][0]['created_at'];
    return $this->theme->scope('home', $data)->render();
  }

  function listByCurrencyCompareToday($currency1,$currency){

    $data['dataKurs']= KursModel::where('created_at',date('Y-m-d'))
                      ->join('currency', 'kurs.currency_code', '=', 'currency.currency_code')
                      ->where('currency_alias',str_slug($currencyName))->orderBy('rate_date','desc')->orderBy('kurs.currency_code','asc')->get();

    $this->theme->setTitle('Kurs Rupiah Hari Ini');
    $data['updatedDate'] = $data['dataKurs'][0]['created_at'];
    return $this->theme->scope('home', $data)->render();
  }

}
