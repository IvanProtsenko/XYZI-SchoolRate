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
use App\Review;
use App\Rating;

class FeedbackController extends Controller
{
    public function ShowFeedback() {
        if(\Auth::User()->status == "moderator" || \Auth::User()->status == "director") {
            $reviews = Review::all()->sortByDesc('updated_at');
            $teachers = User::all()->where('status', 'teacher');
            return view('/reviews/all_reviews', ['reviews' => $reviews], ['teachers' => $teachers]);
        }
        else {
            return redirect('/main');
        }
    }
    public function Accept($id) {
        if(\Auth::User()->status == "moderator") {
            $review = Review::findOrFail($id);
            $review->status = "accepted";
            $review->save();
            return redirect()->back();
        }
        else return redirect('/main');
    }
    public function DeleteReview($id, $id2)
    {
        $review = Review::findOrFail($id2);
        if($review->id_send == \Auth::User()->id || \Auth::User()->status == "moderator" || \Auth::User()->status == "director")
        {
            $review->delete();
        }
        return redirect()->back();
    }
}
