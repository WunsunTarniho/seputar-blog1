<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Comment;
use App\Events\NewComment;
use App\Models\Notification;
use Illuminate\Http\Request;
use App\Events\NewNotification;
use App\Models\NotificationRead;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $postId)
    {
        $causer = Auth::user();

        $comment = Comment::create([
            'post_id' => $postId,
            'content' => $request->content,
            'user_id' => $causer->id,
        ]);

        $notification = Notification::create([
            'causer_id' => $causer->id,
            'recipient_id' => Post::find($postId)->user_id,
            'content' => "$causer->username mengomentari postingan kamu",
        ]);

        $notificationRead = NotificationRead::create([
            'notification_id' => $notification->id,
        ]);

        broadcast(new NewComment($comment));
        broadcast(new NewNotification($notification));

        return response()->json($comment);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
