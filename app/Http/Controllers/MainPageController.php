<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MainPageController extends Controller
{
    public function ShowList() {
        //$teachers = User::where('status', 'teacher')->sortBy('name');
        //['teachers' => $teachers]
        return view('/teachers/all_teachers');
    }
}
