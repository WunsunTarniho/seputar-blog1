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
            $categories = Category::all();

            $notifications = Notification::where('recipient_id', null)
                ->orWhere('recipient_id', Auth::id())
                ->with('notificationReads')
                ->orderBy('created_at', 'desc')
                ->get();

            $notificationRead = NotificationRead::where(function ($query) {
                $query->where('user_id', Auth::id())
                    ->orWhere('is_read', false);
            })->get();

            $view->with('categories', $categories);
            $view->with('notifications', $notifications);
            $view->with('notificationRead', count($notificationRead));
        });
    }
}
