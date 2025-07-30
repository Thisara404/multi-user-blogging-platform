<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'excerpt',
        'content',
        'featured_image',
        'status',
        'author_id',
        'category_id',
        'published_at',
        'views_count',
        'likes_count',
        'comments_count',
    ];

    protected $casts = [
        'published_at' => 'datetime',
    ];

    // Add this method for S3 image URLs
    public function getFeaturedImageUrlAttribute()
    {
        if (!$this->featured_image) {
            return null;
        }

        // Check if we're using S3
        if (config('filesystems.default') === 's3') {
            return Storage::disk('s3')->url($this->featured_image);
        }

        // Fallback to local asset
        return asset($this->featured_image);
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($post) {
            if (empty($post->slug)) {
                $baseSlug = Str::slug($post->title);
                $slug = $baseSlug;
                $counter = 1;

                while (static::where('slug', $slug)->exists()) {
                    $slug = $baseSlug . '-' . $counter;
                    $counter++;
                }

                $post->slug = $slug;
            }
        });

        static::updating(function ($post) {
            if ($post->isDirty('title') && empty($post->slug)) {
                $baseSlug = Str::slug($post->title);
                $slug = $baseSlug;
                $counter = 1;

                while (static::where('slug', $slug)->where('id', '!=', $post->id)->exists()) {
                    $slug = $baseSlug . '-' . $counter;
                    $counter++;
                }

                $post->slug = $slug;
            }
        });
    }

    // Relationships
    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function approvedComments()
    {
        return $this->hasMany(Comment::class)->where('status', 'approved');
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    public function savedByUsers()
    {
        return $this->belongsToMany(User::class, 'saved_posts');
    }

    // Scopes
    public function scopePublished($query)
    {
        return $query->where('status', 'published')
                    ->where('published_at', '<=', now());
    }

    public function scopeDraft($query)
    {
        return $query->where('status', 'draft');
    }

    public function scopeByAuthor($query, $authorId)
    {
        return $query->where('author_id', $authorId);
    }

    // Helper methods
    public function isPublished()
    {
        return $this->status === 'published' && $this->published_at <= now();
    }

    public function isDraft()
    {
        return $this->status === 'draft';
    }

    public function canEdit($user)
    {
        return $user->can('edit posts') &&
               ($user->hasRole('admin') || $this->author_id === $user->id);
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
