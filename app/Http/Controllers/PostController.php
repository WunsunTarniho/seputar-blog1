<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    public function createSlug(Request $request)
    {

        $slug = SlugService::createSlug(Post::class, 'slug', $request->title);
        return response()->json(['slug' => $slug]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('create.post', [
            'title' => "New Post",
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|min:10',
            'slug' => 'required|unique:posts|min:10',
            'category_id' => 'required',
            'desc' => 'required|min:100',
            'image' => 'required|image|file|max:2048',
        ]);

        if ($request->file('image')) {
            $image = $request->file('image');
            $imageData = file_get_contents($image->getRealPath());
            $base64Image = base64_encode($imageData);
            $imagePath = 'data:' . $image->getClientMimeType() . ';base64,' . $base64Image;

            $validated['image'] = $imagePath;
        }

        $validated['user_id'] = Auth::id();

        Post::create($validated);

        return redirect('/')->with('success', 'Post article successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $post = Post::find($id);
        $current_post = $post->where(['category_id' => $post->category_id])->orderBy('created_at', 'desc')->limit(5)->get();
        return view('post', [
            'title' => $post->title,
            'post' => $post,
            'current_post' => $current_post,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
