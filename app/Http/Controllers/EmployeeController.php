<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function index(){
        return view('employee.home');
    }

    public function eval_form(){
        return view('employee.evaluation_form');
    }

    // public function journaling(){
    //     return view('employee.journaling');
    // }

    // public function resources(){
    //     return view('employee.resources');
    // }

    public function appointment(){
        return view('employee.appointments');
    }

    public function chats(){
        return view('employee.chats');
    }
}
