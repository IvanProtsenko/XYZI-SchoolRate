<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class MainPageController extends Controller
{
    public function ShowList() {
        $teachers = User::all()->where('status', 'teacher');
        return view('/teachers/all_teachers', ['teachers' => $teachers]);
    }
}
