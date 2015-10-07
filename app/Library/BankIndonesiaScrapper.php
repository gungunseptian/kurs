<?php

namespace App\Library;
use App\Library\Scrapper;

class BankIndonesiaScrapper extends Scrapper{

    protected $url = "http://www.bi.go.id/id/moneter/informasi-kurs/transaksi-bi/Default.aspx";

    protected $dateIndo = [
              '01' => 'Jan',
              '02' => 'Feb',
              '03' => 'Mar',
              '04' => 'Apr',
              '05' => 'Mei',
              '06' => 'Jun',
              '07' => 'Jul',
              '08' => 'Ags',
              '09' => 'Sep',
              '10' => 'Okt',
              '11' => 'Nov',
              '12' => 'Des'
      ];

    function scrape($paramsSearch){
          $scrape = new Scrapper;

          $scrape->setUrl($this->url);
          $field['currency'] = '//*[@id="ctl00_PlaceHolderMain_biWebKursTransaksiBI_GridView1"]/tr/td[1]';
          $field['rate_sell'] = '//*[@id="ctl00_PlaceHolderMain_biWebKursTransaksiBI_GridView1"]/tr/td[3]';
          $field['rate_buy'] = '//*[@id="ctl00_PlaceHolderMain_biWebKursTransaksiBI_GridView1"]/tr/td[4]';

          $params['ctl00$PlaceHolderMain$biWebKursTransaksiBI$txtFrom'] = isset($paramsSearch['from']) ? $this->convertToIndoDate( date('Y-m-d',strtotime($paramsSearch['from']) ) ) : ''; // set param search
          $params['ctl00$PlaceHolderMain$biWebKursTransaksiBI$txtTo'] =  isset($paramsSearch['to']) ? $this->convertToIndoDate(date('Y-m-d',strtotime($paramsSearch['to']) ) ) : '';

          //$params['ctl00$PlaceHolderMain$biWebKursTransaksiBI$txtTanggal'] = date('d-M-y',strtotime($paramsSearch['from']) );

          $scrape->setParams($params); // set param search
          $scrape->setXpath($field);
          $paramsSearch['rate_date'] = isset($paramsSearch['from']) ? $paramsSearch['from'] : date('Y-m-d',strtotime('-1 days'));
          return $scrape->action($paramsSearch);
    }

    function convertToIndoDate($date){
          return date('d',strtotime($date)).'-'.$this->dateIndo[date('m',strtotime($date))].'-'.date('y',strtotime($date));
    }

}
