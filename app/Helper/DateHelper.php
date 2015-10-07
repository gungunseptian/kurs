<?php

namespace App\Helper;

class DateHelper {

  protected $dateEnglish = [
            'januari' => 'january',
            'februari' => 'february',
            'maret' => 'march',
            'april' => 'April',
            'mei' => 'may',
            'juni' => 'june',
            'juli' => 'july',
            'agustus' => 'august',
            'september' => 'september',
            'oktober' => 'october',
            'november' => 'november',
            'desember' => 'desember'
    ];

  public function monthIndoToEng($month){
      return $this->dateEnglish[strtolower($month)];
  }

}
