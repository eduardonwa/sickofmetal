<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Tag extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'slug'];

    protected $casts = ['tags' => 'array',];

    public static function findFromSlug(string $slug, string $type = null, string $locale = null)
    {
        $locale = $locale ?? app()->getLocale();

        return Static::query()
            ->where("slug->{$locale}", $slug)
            ->where('type', $type)
            ->get();
    }
}
