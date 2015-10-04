<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Library\Scrapper;

class HomeController extends Controller
{
    function index(){

        $scrape = new Scrapper;
        $scrape->setUrl("http://www.bi.go.id/id/moneter/informasi-kurs/transaksi-bi/Default.aspx"); // set url
        $scrape->setParams(array('ctl00$PlaceHolderMain$biWebKursTransaksiBI$txtFrom' => '1-Okt-15', // set param search
                                  'ctl00$PlaceHolderMain$biWebKursTransaksiBI$txtTo' => '1-Okt-15')); // set param search

        $params['currency'] = '//*[@id="ctl00_PlaceHolderMain_biWebKursTransaksiBI_GridView1"]/tr/td[1]';
        $params['rate_sell'] = '//*[@id="ctl00_PlaceHolderMain_biWebKursTransaksiBI_GridView1"]/tr/td[3]';
        $params['rate_buy'] = '//*[@id="ctl00_PlaceHolderMain_biWebKursTransaksiBI_GridView1"]/tr/td[4]';

        $scrape->setXpath($params);
        $result = $scrape->action('BI');

        echo "<pre>";
        print_r($result);
        echo "</pre>";
    }

}
