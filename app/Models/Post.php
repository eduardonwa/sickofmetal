<?php

namespace App\Models;

use App\Models\Tag;
use App\Models\User;
use App\Models\Category;
use App\Models\PostView;
use Spatie\Image\Manipulations;
use Spatie\Tags\HasTags;
use Illuminate\Support\Str;
use Spatie\MediaLibrary\HasMedia;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Post extends Model implements HasMedia
{
    use HasFactory, HasTags, InteractsWithMedia;

    protected $fillable = [
        'title',
        'slug',
        'caption',
        'thumbnail',
        'body',
        'active',
        'published_at',
        'user_id',
        'meta_title',
        'meta_description'
    ];

    protected $casts = [
        'published_at' => 'datetime'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class);
    }

    public function getFormattedDate()
    {
        return $this->published_at->format('F jS Y');
    }

    public function shortBody($words = 30): string
    {
        return Str::words(strip_tags($this->body), $words);
    }

    public function shortTitle($words = 8): string
    {
        return Str::words(strip_tags($this->title), $words);
    }

    public function getThumbnail()
    {
        if(str_starts_with($this->thumbnail, 'http')) {
            return $this->thumbnail;
        }
        return '/storage/'.$this->thumbnail;
    }

    public function humanReadTime(): Attribute
    {
        return new Attribute(
            get: function($value, $attributes) {
                $words = Str::wordCount(strip_tags($attributes['body']));
                $minutes = ceil($words / 200);

                return $minutes. ' '.str('minute')->plural($minutes);
            }
        );
    }

    public function views(): HasMany
    {
        return $this->hasMany(PostView::class);
    }

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('preview')
                ->fit(Manipulations::FIT_CROP, 300, 300)
                ->nonQueued();
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('thumbnails');
    }
}
