<?php

namespace App\Models;

use App\Models\TextWidget;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TextWidget extends Model
{
    use HasFactory;

    protected $fillable = [
        'key',
        'image',
        'title',
        'content',
        'active'
    ];

    public static function getTitle(string $key): string
    {
        $widget = \Illuminate\Support\Facades\Cache::get('text-widget-' . $key, function() use($key) {
            return TextWidget::query()->where('key', '=', $key)->where('active', '=', 1)->first();
        });
            if ($widget) {
                return $widget->title;
            }

            return '';
    }

    public static function getContent(string $key): string
    {
        $widget = \Illuminate\Support\Facades\Cache::get('text-widget-' . $key, function() use ($key) {
            return  TextWidget::query()
                ->where('key', '=', $key)
                ->where('active', '=', 1)
                ->first();
        });
            
            if ($widget) {
                return $widget->content;
            }
            return '';
    }

    public static function getImage(string $key): string
    {
        $widget = \Illuminate\Support\Facades\Cache::get('text-widget-' . $key, function() use ($key) {
            return  TextWidget::query()
                ->where('key', '=', $key)
                ->where('active', '=', 1)
                ->first();
        });
            
        if ($widget && $widget->image) {
            return Storage::url($widget->image);
        }
            return '';
    }
}