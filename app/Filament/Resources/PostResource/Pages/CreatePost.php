<?php

namespace App\Filament\Resources\PostResource\Pages;

use App\Models\Post;
use Filament\Pages\Actions;
use App\Filament\Resources\PostResource;
use Filament\Resources\Pages\CreateRecord;
use Pboivin\FilamentPeek\Pages\Actions\PreviewAction;
use Pboivin\FilamentPeek\Pages\Concerns\HasPreviewModal;

class CreatePost extends CreateRecord
{
    use HasPreviewModal;
    
    protected static string $resource = PostResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['user_id'] = auth()->id();
    
        return $data;
    }

    protected function getActions(): array
    {
        return [
            PreviewAction::make(),
        ];
    }

    protected function getPreviewModalView(): ?string
    {
        return 'post.view';
    }

    protected function getPreviewModalDataRecordKey(): ?string
    {
        return 'post';
    }
}