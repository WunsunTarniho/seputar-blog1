<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use App\Models\Category;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function home(){
        $trendingPost = Post::whereNotNull('image')
                        ->orderBy('views', 'desc')
                        ->take(5)
                        ->get();

        return view('dashboard', [
            'title' => 'Seputar Blog',
            'trendingPost' => $trendingPost,
        ]);
    }
}
