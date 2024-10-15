<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Like;
use App\Models\Post;
use App\Models\User;
use App\Models\Comment;
use App\Models\Category;
use App\Models\Favorite;
use App\Models\Notification;
use Illuminate\Database\Seeder;
use App\Models\NotificationRead;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        $image = 'data:image/webp;base64,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';


        $user1 = User::factory()->create([
            'username' => 'Wunsun Tarniho',
            'email' => 'wunsun58@gmail.com',
            'phone' => "081285388658",
            'password' => "admin1234",
            'roles' => 'admin',
        ]);

        $category1 = Category::factory()->create([
            'slug' => 'politic',
            'name' => 'Politic',
        ]);

        Category::factory()->create([
            'slug' => 'economic',
            'name' => 'Economic',
        ]);

        Category::factory()->create([
            'slug' => 'technology',
            'name' => 'Technology',
        ]);

        $post1 = Post::factory()->create([
            'user_id' => $user1->id,
            'category_id' => $category1->id,
            'slug' => 'gibran-akan-lolos-dari-ptun?',
            'title' => 'Gibran akan lolos dari PTUN?',
            'image' => $image,
            'desc' => 'akljsfdskljffffjfjfjfjfjfjfjfjfjfjfjfjfjfjfjfjfjfjfjfjfjfj',
            'views' => 10,
        ]);

        Post::factory()->create([
            'user_id' => $user1->id,
            'category_id' => $category1->id,
            'slug' => 'gibran-akan-lolos-dari-ptun',
            'title' => 'Gibran akan lolos dari PTUN?',
            'desc' => 'akljsfdskljffffjfjfjfjfjfjfjfjfjfjfjfjfjfjfjfjfjfjfjfjfjfj',
            'image' => $image,
            'views' => 10,
        ]);
        Post::factory()->create([
            'user_id' => $user1->id,
            'category_id' => $category1->id,
            'slug' => 'gibran-akan-lolos-dari-ptun1',
            'title' => 'Gibran akan lolos dari PTUN?',
            'desc' => 'akljsfdskljffffjfjfjfjfjfjfjfjfjfjfjfjfjfjfjfjfjfjfjfjfjfj',
            'image' => $image,
            'views' => 10,
        ]);
        Post::factory()->create([
            'user_id' => $user1->id,
            'category_id' => $category1->id,
            'slug' => 'gibran-akan-lolos-dari-ptun2',
            'title' => 'Gibran akan lolos dari PTUN?',
            'desc' => 'akljsfdskljffffjfjfjfjfjfjfjfjfjfjfjfjfjfjfjfjfjfjfjfjfjfj',
            'image' => $image,
            'views' => 10,
        ]);
        Post::factory()->create([
            'user_id' => $user1->id,
            'category_id' => $category1->id,
            'slug' => 'gibran-akan-lolos-dari-ptun3',
            'title' => 'Gibran akan lolos dari PTUN?',
            'desc' => 'akljsfdskljffffjfjfjfjfjfjfjfjfjfjfjfjfjfjfjfjfjfjfjfjfjfj',
            'image' => $image,
            'views' => 10,
        ]);
        Post::factory()->create([
            'user_id' => $user1->id,
            'category_id' => $category1->id,
            'slug' => 'gibran-akan-lolos-dari-ptun4',
            'title' => 'Gibran akan lolos dari PTUN?',
            'desc' => 'akljsfdskljffffjfjfjfjfjfjfjfjfjfjfjfjfjfjfjfjfjfjfjfjfjfj',
            'image' => $image,
            'views' => 10,
        ]);
        Post::factory()->create([
            'user_id' => $user1->id,
            'category_id' => $category1->id,
            'slug' => 'gibran-akan-lolos-dari-ptun5',
            'title' => 'Gibran akan lolos dari PTUN?',
            'desc' => 'akljsfdskljffffjfjfjfjfjfjfjfjfjfjfjfjfjfjfjfjfjfjfjfjfjfj',
            'image' => $image,
            'views' => 10,
        ]);
        
        Post::factory()->create([
            'user_id' => $user1->id,
            'category_id' => $category1->id,
            'slug' => 'gibran-akan-lolos-dari-ptun6',
            'title' => 'Gibran akan lolos dari PTUN?',
            'desc' => 'akljsfdskljffffjfjfjfjfjfjfjfjfjfjfjfjfjfjfjfjfjfjfjfjfjfj',
            'views' => 10,
        ]);

        $comment1 = Comment::factory()->create([
            'user_id' => $user1->id,
            'post_id' => $post1->id,
            'content' => 'good',
        ]);

        Favorite::factory()->create([
            'user_id' => $user1->id,
            'post_id' => $post1->id,
        ]);

        Like::factory()->create([
            'user_id' => $user1->id,
            'comment_id' => $comment1->id,
        ]);

        $notification1 = Notification::factory()->create([
            'user_id' => $user1->id,
            'content' => $user1->username . " like your comment.",
        ]);

        NotificationRead::factory()->create([
            'user_id' => $user1->id,
            'notification_id' => $notification1->id,
            'is_read' => false,
        ]);
    }
}
