<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use MongoDB\Laravel\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    use HasFactory, Sluggable;

    protected $guarded = ['id'];

    public function comments(){
        return $this->hasMany(Comment::class);
    }

    public function Favorites(){
        return $this->hasMany(Favorite::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }
}
