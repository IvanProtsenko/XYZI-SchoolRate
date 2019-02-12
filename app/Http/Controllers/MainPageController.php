<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Routing\Redirector;
use Illuminate\Support\ServiceProvider;
use Illuminate\Http\RedirectResponse;
use App\User;
use App\Rating;

class MainPageController extends Controller
{
    public function ShowList(Request $request) {
        if(\Auth::User()->condition == "active") {
        $selected = 0;
        if(isset($request->sort)) {
            $selected = $request->sort;
            if($selected == "2") {
                $teachers = User::all()->where('status', 'teacher')->sortBy('subject');
            }
            elseif($request->sort == "3") {
                $teachers = User::all()->where('status', 'teacher')->sortByDesc('likes');
            }
            else $teachers = User::all()->where('status', 'teacher')->sortBy('name');
        }
        else {
            $teachers = User::all()->where('status', 'teacher')->sortBy('name');
        }
        if(isset($request->search)) {
            $teachers = User::all()->where('name', $request->search)->where('status', 'teacher');
        }
        foreach($teachers as $teacher) {
            $rating = Rating::all()->where('teacher_id', $teacher->id);
            if($rating != null && count($rating) != 0) $teacher->likes = intval(count($rating->where('rate', 1))/count($rating)*100);
            else $teacher->likes = -1;
            $teacher->save();
        }
        return view('/teachers/all_teachers', ['teachers' => $teachers], ['selected' => $selected]);
        }
        elseif(\Auth::User()->condition == "banned") {
            return view('/layouts/ban_page');
        }
        else {
            return view('/layouts/waiting_page');
        }
    }
    public function DeleteTeacher($id)
    {
        $teacher = User::findOrFail($id);
        if(\Auth::User()->status == "moderator")
        {
            $teacher->delete();
        }
        else {
            return redirect('/main');
        }
    }
    public function AddTeacherView(Request $request)
    {
        if(\Auth::User()->status == "moderator") {
            return view('/teachers/add_teacher');
        }
        else {
            return redirect('main');
        }
    }
    public function EditTeacherView(Request $request)
    {
        if(\Auth::User()->status == "moderator") {
            $teacher = User::findOrFail($request->id);
            return view('/teachers/edit_teacher', ['teacher' => $teacher]);
        }
        else {
            return redirect('main');
        }
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
    public function EditTeacher(Request $request)
    {
        if(\Auth::User()->status == "moderator") {
            $teacher = User::findOrFail($request->id);
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
                $path = $request->file('image')->storeAs('user_avatars', $teacher->id . $extn);
                $teacher->image = $path;
            }
            $teacher->save();
            return redirect('/main');
        }
        else {
            redirect()->back();
        }
    }
    public function Like($teacher_id)
    {
        if($rating = Rating::where('teacher_id', $teacher_id)->where('user_id', \Auth::User()->id)->first()) {
            $rating->rate = true;
        }
        else {
            $rating = new Rating;
            $rating->teacher_id = $teacher_id;
            $rating->user_id = \Auth::User()->id;
            $rating->rate = true;
        }
        $rating->save();
        return redirect()->back();
    }
    public function Dislike($teacher_id)
    {
        if($rating = Rating::where('teacher_id', $teacher_id)->where('user_id', \Auth::User()->id)->first()) {
            $rating->rate = false;
        }
        else {
            $rating = new Rating;
            $rating->teacher_id = $teacher_id;
            $rating->user_id = \Auth::User()->id;
            $rating->rate = false;
        }
        $rating->save();
        return redirect()->back();
    }
    public function ShowRequests() {
        if(\Auth::User()->status == "moderator") {
            $users = User::all()->where('condition', 'waiting');
            return view('/layouts/requests', ['users' => $users]);
        }
        else {
            return redirect('/main');
        }
    }
    public function AboutUs() {
        return view('/layouts/about_us');
    }
}
