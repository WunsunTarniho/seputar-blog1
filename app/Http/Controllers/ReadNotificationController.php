<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use App\Models\NotificationRead;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReadNotificationController extends Controller
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
    public function store(Request $request)
    {
        $user = Auth::user();
        $notifications = Notification::with('notificationReads')
            ->where('recipient_id', null)
            ->orWhere('recipient_id', $user->id)
            ->get();

        foreach ($notifications as $index => $notification) {
            if (!count($notification->notificationReads()->where('user_id', $user->id)->get())) {
                NotificationRead::create([
                    'user_id' => $user->id,
                    'notification_id' => $notifications[$index]->id,
                    'is_read' => true,
                ]);
            }
        }

        return response()->json([
            'halo' => $notifications,
            'message' => 'Notification already read.',
        ]);
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
