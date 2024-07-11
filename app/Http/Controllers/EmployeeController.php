<?php

namespace App\Http\Controllers;
use App\Models\Feedback;
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

    // public function appointment(){
    //     return view('employee.appointments');
    // }

    public function chats(){
        $feedbacks = [];
        $messages = [];
        // Return the view with the feedback data
        return view('employee.chats', compact('feedbacks', 'messages'));
    }
}
