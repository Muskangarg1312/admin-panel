<?php

namespace App\Controllers;
use App\Models\DayBookModel;
use App\Models\CustomerModel;
use App\Models\BankAccountModel;

$session = \Config\Services::session();

class DayBookController extends BaseController
{

    public function __constructor() {
        $session = session();
    }

    // public function welcome(){
    //     return view('welcome_message');
    // }

    public function all_day_book()
    {   

        $daybook = new DayBookModel();
        $data['dates'] = $daybook->getDates();
       // dd($data);
       //  var_dump($data);
       //  die;

        return view('pages/day_book/all_day_book', $data);
    }

    public function view_day_book($date)
    {   

          $daybook = new DayBookModel();
          $data['date'] = $date;
          $data['day_book'] = $daybook->where('date', $date)->findAll();
        
         // dd($data['day_book']);

        return view('pages/day_book/view_day_book', $data);
    }

   
}