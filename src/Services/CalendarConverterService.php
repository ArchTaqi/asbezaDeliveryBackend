<?php

namespace App\Services;


 class CalendarConverterService{
  
	private $qen=0;
	private  $wer=0;
	private  $amet = 0;
	private  $day=0;
	private  $month=0;
    private  $year=0;
    private $nyear=0;
          
    public function __construct(){

    }
  

  public function dateConverter() {
      $this->qen = 0;
     
     

	  
           $this->day = date("d");
            $this->month = date("m");
            $this->year = date("Y");


            if ($this->month < 3)
            {
                if ($this->year % 4 != 0)
                {
                    //Tir ==>>Jan 9-31 Feb 1-7
                    if ($this->month == 1 && 9 <= $this->day && $this->day <= 31)
                    {
                        $this->wer = 5;
                        $this->qen = $this->day - 8;
                        $this->amet = $this->year - 8;
                    }
                    if ($this->month == 1 && 1 <= $this->day && $this->day <= 8)
                    {
                        $this->wer = 4;
                        $this->qen = $this->day + 22;
                        $this->amet = $this->year - 8;
                    }
                    //Tir

                    //Yekatit==>>Feb 8-28 mar 1-9
                    if ($this->month == 2 && 8 <= $this->day && $this->day <= 28)
                    {
                        $this->wer = 6;
                        $this->qen = $this->day - 7;
                        $this->amet = $this->year - 8;
                    }
                    if ($this->month == 2 && 1 <= $this->day && $this->day <= 7)
                    {
                        $this->wer = 5;
                        $this->qen = $this->day + 23;
                        $this->amet = $this->year - 8;
                    }
                    //Yekatit

                }


                if ($this->year % 4 == 0)
                {

                    //Tir ==>>Jan 10-31 Feb 1-8
                    if ($this->month == 1 && 10 <= $this->day && $this->day <= 31)
                    {
                        $this->wer = 5;
                        $this->qen = $this->day - 9;
                        $this->amet = $this->year - 8;
                    }
                    if ($this->month == 1 && 1 <= $this->day && $this->day <= 9)
                    {
                        $this->wer = 4;
                        $this->qen = $this->day + 21;
                        $this->amet = $this->year - 8;
                    }
                    //Tir

                    //Yekatit==>>Feb 9-29 mar 1-9
                    if ($this->month == 2 && 9 <= $this->day && $this->day <= 29)
                    {
                        $this->wer = 6;
                        $this->qen = $this->day - 8;
                        $this->amet = $this->year - 8;
                    }
                    if ($this->month == 2 && 1 <= $this->day && $this->day <= 8)
                    {
                        $this->wer = 5;
                        $this->qen = $this->day + 22;
                        $this->amet = $this->year - 8;
                    }
                    //Yekatit

                }

            }
            if ($this->month >= 3)
            {
               $this->nyear = $this->year + 1;
                if ($this->nyear % 4 != 0)
                {

                    //meskerem
                    if ($this->month == 9 && 11 <= $this->day && $this->day <= 30)
                    {
                        $this->wer = 1;
                        $this->qen = $this->day - 10;
                        $this->amet = $this->year - 7;
                    }
                    if ($this->month == 9 && 1 <= $this->day && $this->day <= 5)
                    {
                        $this->wer = 12;
                        $this->qen = $this->day + 25;
                        $this->amet = $this->year - 8;
                    }
                    if ($this->month == 9 && 6 <= $this->day && $this->day <= 10)
                    {
                        $this->wer = 13;
                        $this->qen = $this->day - 5;
                        $this->amet = $this->year - 8;
                    }
                    //meskerem

                    //Tikimt
                    if ($this->month == 10 && 11 <= $this->day && $this->day <= 31)
                    {
                        $this->wer = 2;
                        $this->qen = $this->day - 10;
                        $this->amet = $this->year - 7;
                    }
                    if ($this->month == 10 && 1 <= $this->day && $this->day <= 10)
                    {
                        $this->wer = 1;
                        $this->qen = $this->day + 20;
                        $this->amet = $this->year - 7;
                    }
                    //Tikimt

                    //Hidar
                    if ($this->month == 11 && 10 <= $this->day && $this->day <= 30)
                    {
                        $this->wer = 3;
                        $this->qen = $this->day - 9;
                        $this->amet = $this->year - 7;
                    }
                    if ($this->month == 11 && 1 <= $this->day && $this->day <= 9)
                    {
                        $this->wer = 2;
                        $this->qen = $this->day + 21;
                        $this->amet = $this->year - 7;
                    }
                    //Hidar

                    //Tahisas==>>Dec 10-31  Jan 1-8
                    if ($this->month == 12 && 10 <= $this->day && $this->day <= 31)
                    {
                        $this->wer = 4;
                        $this->qen = $this->day - 9;
                        $this->amet = $this->year - 7;
                    }
                    if ($this->month == 12 && 1 <= $this->day && $this->day <= 9)
                    {
                        $this->wer = 3;
                        $this->qen = $this->day + 21;
                        $this->amet = $this->year - 7;
                    }
                    //Tahisas
                }
                if ($this->nyear % 4 == 0)
                {

                    //meskerem
                    if ($this->month == 9 && 12 <= $this->day && $this->day <= 30)
                    {
                        $this->wer = 1;
                        $this->qen = $this->day - 11;
                        $this->amet = $this->year - 7;
                    }
                    if ($this->month == 9 && 1 <= $this->day && $this->day <= 5)
                    {
                        $this->wer = 12;
                        $this->qen = $this->day + 25;
                        $this->amet = $this->year - 8;
                    }
                    if ($this->month == 9 && 6 <= $this->day && $this->day <= 11)
                    {
                        $this->wer = 13;
                        $this->qen = $this->day - 5;
                        $this->amet = $this->year - 8;
                    }
                    //meskerem

                    //Tikimt
                    if ($this->month == 10 && 12 <= $this->day && $this->day <= 31)
                    {
                        $this->wer = 2;
                        $this->qen = $this->day - 11;
                        $this->amet = $this->year - 7;
                    }
                    if ($this->month == 10 && 1 <= $this->day && $this->day <= 11)
                    {
                        $this->wer = 1;
                        $this->qen = $this->day + 19;
                        $this->amet = $this->year - 7;
                    }
                    //Tikimt

                    //Hidar
                    if ($this->month == 11 && 11 <= $this->day && $this->day <= 30)
                    {
                        $this->wer = 3;
                        $this->qen = $this->day - 10;
                        $this->amet = $this->year - 7;
                    }
                    if ($this->month == 11 && 1 <= $this->day && $this->day <= 10)
                    {
                        $this->wer = 2;
                        $this->qen = $this->day + 20;
                        $this->amet = $this->year - 7;
                    }
                    //Hidar

                    //Tahisas==>>Dec 11-31  Jan 1-9
                    if ($this->month == 12 && 11 <= $this->day && $this->day <= 31)
                    {
                        $this->wer = 4;
                        $this->qen = $this->day - 10;
                        $this->amet = $this->year - 7;
                    }
                    if ($this->month == 12 && 1 <= $this->day && $this->day <= 10)
                    {
                        $this->wer = 3;
                        $this->qen = $this->day + 20;
                        $this->amet = $this->year - 7;
                    }
                    //Tahisas
                }



                //Megabit==>> march 10-31 Apr1 1-8
                if ($this->month == 3 && 10 <= $this->day && $this->day <= 31)
                {
                    $this->wer = 7;
                    $this->qen = $this->day - 9;
                    $this->amet = $this->year - 8;
                }
                if ($this->month == 3 && 1 <= $this->day && $this->day <= 9)
                {
                    $this->wer = 6;
                    $this->qen = $this->day + 21;
                    $this->amet = $this->year - 8;
                }
                //Megabit

                //Miazia==>> April9-30 May 1-8
                if ($this->month == 4 && 9 <= $this->day && $this->day <= 30)
                {
                   $this->wer = 8;
                    $this->qen = $this->day - 8;
                    $this->amet = $this->year - 8;
                }
                if ($this->month == 4 && 1 <= $this->day && $this->day <= 8)
                {
                    $this->wer = 7;
                    $this->qen = $this->day + 22;
                    $this->amet = $this->year - 8;
                }
                //Miazia

                //Ginbot==>> May9-31  June 1-7
                if ($this->month == 5 && 9 <= $this->day && $this->day <= 31)
                {
                    $this->wer = 9;
                    $this->qen = $this->day - 8;
                    $this->amet = $this->year - 8;
                }
                if ($this->month == 5 && 1 <= $this->day && $this->day <= 8)
                {
                    $this->wer = 8;
                    $this->qen = $this->day + 22;
                    $this->amet = $this->year - 8;
                }
                //Ginbot

                //Sene==>>June 8-30 July 1-7
                if ($this->month == 6 && 8 <= $this->day && $this->day <= 30)
                {
                    $this->wer = 10;
                    $this->qen = $this->day - 7;
                    $this->amet = $this->year - 8;
                }
                if ($this->month == 6 && 1 <= $this->day && $this->day <= 7)
                {
                    $this->wer = 9;
                    $this->qen = $this->day + 23;
                    $this->amet = $this->year - 8;
                }
                //Sene

                //Hamle==>> July 8-31 Aug 1-6
                if ($this->month == 7 && 8 <= $this->day && $this->day <= 31)
                {
                    $this->wer = 11;
                    $this->qen = $this->day - 7;
                    $this->amet = $this->year - 8;
                }
                if ($this->month == 7 && 1 <= $this->day && $this->day <= 7)
                {
                    $this->wer = 10;
                    $this->qen = $this->day + 23;
                    $this->amet = $this->year - 8;
                }
                //Hamle

                //Nehase==>> Aug 7-31 Sep 1-5
                if ($this->month == 8 && 7 <= $this->day && $this->day <= 31)
                {
                    $this->wer = 12;
                    $this->qen = $this->day - 6;
                    $this->amet = $this->year - 8;
                }
                if ($this->month == 8 && 1 <= $this->day && $this->day <= 6)
                {
                    $this->wer = 11;
                    $this->qen = $this->day + 24;
                    $this->amet = $this->year - 8;
                }
                //Nehase
            }
			
            $et_qen = $this->qen;
            $et_wer = $this->wer;
            $et_amet = $this->amet;
          
            if ($this->qen < 10)
            {
               $et_qen = "0".$this->qen;
            }
            
            if ($this->wer < 10)
            {
               $et_wer = "0".$this->wer;
               
            }

            // echo 'converted day '.$et_qen;
           
            $et_Date = "$et_qen/$et_wer/$et_amet";
//            $et_Date = "$et_amet-$et_wer-$et_qen";
            // echo 'converted date '.$et_Date;
      $time = strtotime($et_Date);

      $newformat = date('Y-m-d',$time);

			//the system's date and time must be set to UTC in order to convert the day correctly
			return [$et_qen, $et_wer,$et_amet, $newformat];
  }
}
 
