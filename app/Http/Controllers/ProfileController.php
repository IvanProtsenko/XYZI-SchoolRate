<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Review;
use App\Rating;

class ProfileController extends Controller
{
    public function ShowProfile($id) {
        if(\Auth::User()->condition == "active") {
            $teacher = User::findorFail($id);
            if ($teacher->status == "teacher") {
                $reviews = Review::all()->where('id_get', $id);
                $rating = Rating::all()->where('teacher_id', $id);
                if ($rating != null && count($rating) != 0) $teacher->likes = intval(count($rating->where('rate', 1)) / count($rating) * 100);
                else $teacher->likes = -1;
                $teacher->save();
                return view('/teachers/teacher_view', ['teacher' => $teacher], ['reviews' => $reviews]);
            } else {
                return redirect('/main');
            }
        }
        else {
            return redirect('/main');
        }
    }
    public function AddReview($teacher_id, Request $request) {
        $teacher = User::findorFail($teacher_id);
        if (Auth::check()) {
            $user_id = \Auth::User()->id;
        }
        $review = new Review;
        $review->id_send = $user_id;
        $review->id_get = $teacher->id;
        $review->text = $request->text;
        $review->status = "waiting";
        $review->rating = "5";
        $review->save();
        return redirect('/profile'.$teacher->id);
    }
    public function Accept($id) {
        if(\Auth::User()->status == "moderator") {
            $user = User::findOrFail($id);
            $user->condition = "active";
            $user->save();
            return redirect()->back();
        }
        else return redirect('/main');
    }
    public function Delete($id) {
        if(\Auth::User()->status == "moderator") {
            $user = User::findOrFail($id);
            $user->delete();
            return redirect()->back();
        }
        else return redirect('/main');
    }
}
