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
    public function DeleteTeacher($id)
    {
        $teacher = User::findOrFail($id);
        if(\Auth::User()->status == "moderator")
        {
            $teacher->delete();
        }
        return redirect('/main');
    }
    public function AddTeacherView(Request $request)
    {
        return view('/teachers/add_teacher');
    }
    public function AddTeacher(Request $request)
    {
        $teacher = new User;
        $teacher->name = $request->name;
        $teacher->email = $request->email;
        $teacher->subject = $request->subject;
        $teacher->status = "teacher";
        $teacher->age = $request->age;
        $teacher->stage = $request->stage;
        $teacher->password = $request->password;
        $teacher->save();
        return redirect('/main');
    }
}
