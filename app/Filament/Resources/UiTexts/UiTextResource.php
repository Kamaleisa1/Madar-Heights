<?php

namespace App\Filament\Resources\UiTexts;

use App\Filament\Resources\UiTexts\Pages\EditUiText;
use App\Filament\Resources\UiTexts\Pages\ListUiTexts;
use App\Models\UiText;
use BackedEnum;
use Filament\Actions\EditAction;
use Filament\Forms\Components\Textarea;
use Filament\Resources\Resource;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Text;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class UiTextResource extends Resource
{
    protected static ?string $model = UiText::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedLanguage;

    protected static ?string $modelLabel = 'نص';

    protected static ?string $pluralModelLabel = 'نصوص الموقع';

    protected static ?string $navigationLabel = 'نصوص الموقع (العناوين والأزرار)';

    protected static ?int $navigationSort = 8;

    public static function canCreate(): bool
    {
        return false;
    }

    public static function form(Schema $schema): Schema
    {
        return $schema->columns(1)->components([
            Section::make()->schema([
                Text::make(fn (?UiText $record) => 'النص الأصلي: '.$record?->key),
                Text::make('لو النص فيه كلمات زي :name أو :city سيبها زي ما هي، دي بتتبدل تلقائياً. ولو فيه <span class="grad">…</span> ده اللي بيظهر بلون مميز.'),
                Textarea::make('ar')->label('النص بالعربي')->required()->rows(3),
                Textarea::make('en')->label('النص بالإنجليزي')->rows(3)->extraInputAttributes(['dir' => 'ltr']),
            ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->defaultSort('id')
            ->columns([
                TextColumn::make('ar')->label('عربي')->searchable()->wrap()->limit(90)->html(false),
                TextColumn::make('en')->label('English')->searchable()->wrap()->limit(90),
            ])
            ->recordActions([EditAction::make()]);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListUiTexts::route('/'),
            'edit' => EditUiText::route('/{record}/edit'),
        ];
    }
}
