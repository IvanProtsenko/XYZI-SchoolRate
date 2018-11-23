<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MainPageController extends Controller
{
    public function ShowList() {
        $teachers = User::where('status', 'teacher')->sortBy('name');
        return view('/teachers/all_teachers', ['teachers' => $teachers]);
    }
}
