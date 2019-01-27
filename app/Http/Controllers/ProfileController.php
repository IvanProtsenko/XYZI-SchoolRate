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
        $teacher = User::findorFail($id);
        $reviews = Review::all()->where('id_get', $id);
        $rating = Rating::all()->where('teacher_id', $id);
        if($rating != null && count($rating) != 0) $teacher->likes = intval(count($rating->where('rate', 1))/count($rating)*100);
        else $teacher->likes = -1;
        $teacher->save();
        return view('/teachers/teacher_view', ['teacher' => $teacher], ['reviews' => $reviews]);
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
    public function DeleteReview($id, $id2)
    {
        $review = Review::findOrFail($id2);
        if($review->id_send == \Auth::User()->id || \Auth::User()->status == "moderator")
        {
            $review->delete();
        }
        return redirect('/profile'.$id);
    }
}
