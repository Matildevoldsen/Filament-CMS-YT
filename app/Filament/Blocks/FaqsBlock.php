<?php

namespace App\Filament\Blocks;

use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\TextInput;
use FilamentTiptapEditor\TiptapBlock;

class FaqsBlock extends TiptapBlock
{
    public string $preview = 'blocks.previews.faqs';

    public string $rendered = 'blocks.rendered.faqs';

    public function getFormSchema(): array
    {
        return [
            Repeater::make('accordions')->schema([
                TextInput::make('question'),
                RichEditor::make('answer')
            ])
        ];
    }
}
