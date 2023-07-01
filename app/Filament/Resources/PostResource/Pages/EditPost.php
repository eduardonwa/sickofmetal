<?php

namespace App\Filament\Resources\PostResource\Pages;

use App\Models\Post;
use Filament\Pages\Actions;
use Illuminate\Support\Carbon;
use App\Filament\Resources\PostResource;
use Filament\Resources\Pages\EditRecord;
use Pboivin\FilamentPeek\Pages\Actions\PreviewAction;
use Pboivin\FilamentPeek\Pages\Concerns\HasPreviewModal;

class EditPost extends EditRecord
{
    use HasPreviewModal;

    protected static string $resource = PostResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
            PreviewAction::make(),
        ];
    }

    protected function getPreviewModalView(): ?string
    {
        return 'post.preview';
    }

    protected function getPreviewModalDataRecordKey(): ?string
    {   
        return 'preview';
    }
}
