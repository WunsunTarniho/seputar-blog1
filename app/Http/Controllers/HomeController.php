<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

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
