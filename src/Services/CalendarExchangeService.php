<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 9/23/2019
 * Time: 5:51 PM
 */

namespace App\Services;


use Andegna\DateTimeFactory;
use DateTimeZone;


class CalendarExchangeService
{

    public function etFromGreg(string $gregDate)
    {

        $ymd = new \DateTime($gregDate);
        $ethiopic = DateTimeFactory::fromDateTime($ymd);

        $day = $ethiopic->getDay();
        $month = $ethiopic->getMonth();
        $year= $ethiopic->getYear();

        if($day<10){
            $day="0".$day;
        }
        if($month<10){
            $month="0".$month;
        }

        return $day . "/" .$month . "/" . $year;
//        return $ethiopic->getDay() . "/" . $ethiopic->getMonth() . "/" . $ethiopic->getYear();
    }

    public function etToGreg(string $etDate)
    {

        $etValue  = explode("/", $etDate);
        $etCalendar = DateTimeFactory::of($etValue[2], $etValue[1], $etValue[0]);

        $gregorian = $etCalendar->toGregorian();

        return $gregorian;
    }

    public function etNow()
    {
        $ethiopic = DateTimeFactory::now();

        $day = $ethiopic->getDay();
        $month = $ethiopic->getMonth();
        $year= $ethiopic->getYear();

        if($day<10){
            $day="0".$day;
        }
        if($month<10){
            $month="0".$month;
        }


        return $day . "/" .$month . "/" . $year;
//        return $ethiopic->getDay() . "/" . $ethiopic->getMonth() . "/" . $ethiopic->getYear();
    }
}