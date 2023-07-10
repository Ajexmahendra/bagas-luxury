<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Slide;
use App\Models\Feature;
use App\Models\Testimonial;
use App\Models\Post;
use App\Models\Review;
use App\Models\Room;

class HomeController extends Controller
{
    public function index()
    {
        $slide_all = Slide::get();
        $feature_all = Feature::get();
        $testimonial_all = Testimonial::get();
        // $post_all = Post::orderBy('id', 'desc')->limit(3)->get();
        $review = Review::with('order', 'customer')->limit(3)->get();
        $room_all = Room::with('roomPhoto')->get();
        // dd($room_all);

        return view('front.home', compact('slide_all', 'feature_all', 'testimonial_all', 'review', 'room_all'));
    }
}
