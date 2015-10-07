<?php

namespace App\Http\Models;

use DB;
use Illuminate\Database\Eloquent\Model;

class KursModel extends Model {

    protected $table = 'kurs';

    public static function getByCurrencyCode($currencyCode,$field=false,$type=false){
        $data = self::where('currency_code',$currencyCode);
        if($field && $type) $data->orderBy($field,$type);
        return $data->get();
    }

    public function currency(){
      return $this->hasOne('App\Http\Models\CurrencyModel');
    }
}
