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
        $reviews = Review::all()->sortByDesc('updated_at');
        $teachers = User::all()->where('status', 'teacher');
        return view('/reviews/all_reviews', ['reviews' => $reviews], ['teachers' => $teachers]);
    }
    public function Accept($id) {
        $review = Review::findOrFail($id);
        $review->status = "accepted";
        $review->save();
        return redirect()->back();
    }
}
