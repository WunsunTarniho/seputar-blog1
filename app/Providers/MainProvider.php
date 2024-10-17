<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\Notification;
use App\Models\NotificationRead;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class MainProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        View::composer(['main', 'create.post', 'dashboard'], function ($view) {
            $categories = Category::with(['posts' => function ($query) {
                $query->orderBy('views', 'desc'); // Urutkan berdasarkan jumlah view (descending)
            }])->get();

            $notifications = Notification::with('notificationReads')
                ->where('recipient_id', null)
                ->orWhere('recipient_id', Auth::id())
                ->orderBy('created_at', 'desc')
                ->get();

            $notificationRead = 0;
            // @dd($notifications[0]->notificationReads()->where('user_id', Auth::id())->get());
            foreach ($notifications as $notification) {
                // @dd($notification->notificationReads()->where('user_id', Auth::id())->get());
                if (!count($notification->notificationReads()->where('user_id', Auth::id())->get())) {
                    $notificationRead += 1;
                }
            }

            $view->with('categories', $categories);
            $view->with('notifications', $notifications);
            $view->with('notificationRead', $notificationRead);
        });
    }
}
