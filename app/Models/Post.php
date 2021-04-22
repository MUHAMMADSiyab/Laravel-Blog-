<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'video',
        'description',
        'user_id',
    ];

    /**
     * Checks whether the user trying to edit/delete the post is the one who created it
     * @param App\Models\Post $post
     * @return bool
     */
    public static function checkPosterIdentity(Post $post): bool
    {
        if (!auth()->user()->is_admin) {
            if ($post->user_id !== auth()->id()) {
                return false;
            }

            return true;
        }
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
