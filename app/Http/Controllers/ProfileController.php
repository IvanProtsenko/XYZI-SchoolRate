<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class ProfileController extends Controller
{
    public function ShowProfile($id) {
        $teachers = User::findorFail(1);
        return view('/teachers/teacher_view', ['teachers' => $teachers]);
    }
    public function AddReview(Request $request) {
        $review = new Review;
        $review->id_send = $request->id_send;
        $review->id_get = $request->id_get;
        $review->text = $request->text;
        $review->status = "waiting";
        $review->save();
        return redirect('/reviews/add_review'.$review->id);
    }
}
