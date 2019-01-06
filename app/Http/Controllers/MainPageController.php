<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
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
    protected function validator(array $request)
    {
        return Validator::make($request, [
            'image' => 'required|image|mimes:jpeg,jpg,png,bmp,gif,svg'
        ]);
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
        $teacher->password = Hash::make($request->password);
        $teacher->save();
        $this->validator($request->all())->validate();
        if ($request->hasFile('image')) {
            $extn = '.' . $request->file('image')->guessClientExtension();
            $path = $request->file('image')->storeAs('user_avatars', $teacher->id.$extn);
            $teacher->image = $path;
        }
        $teacher->save();
        return redirect('/main');
    }
}
