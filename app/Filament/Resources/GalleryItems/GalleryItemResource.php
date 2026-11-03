<?php

namespace App\Filament\Resources\GalleryItems;

use App\Filament\Resources\GalleryItems\Pages\CreateGalleryItem;
use App\Filament\Resources\GalleryItems\Pages\EditGalleryItem;
use App\Filament\Resources\GalleryItems\Pages\ListGalleryItems;
use App\Filament\Support\Fields;
use App\Models\GalleryItem;
use App\Models\Service;
use BackedEnum;
use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Filament\Resources\Resource;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class GalleryItemResource extends Resource
{
    protected static ?string $model = GalleryItem::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedPhoto;

    protected static ?string $modelLabel = 'صورة';

    protected static ?string $pluralModelLabel = 'معرض الأعمال';

    protected static ?int $navigationSort = 4;

    public static function form(Schema $schema): Schema
    {
        return $schema->columns(1)->components([
            Section::make()->schema([
                Grid::make(2)->schema([
                    Fields::image('image', 'الصورة (أو صورة "بعد")', 'gallery')->required(),
                    Fields::image('before_image', 'صورة "قبل" (اختياري)', 'gallery')
                        ->helperText('لو رفعت صورة "قبل"، الصورتين هيظهروا جنب بعض كمقارنة قبل وبعد.'),
                ]),
                Select::make('service_slug')->label('الخدمة')
                    ->options(fn () => Service::orderBy('sort')->pluck('title_ar', 'slug'))
                    ->helperText('الصورة هتظهر تحت الخدمة دي في المعرض وفي صفحة الخدمة'),
                Fields::text('caption', 'وصف قصير (اختياري)'),
                Toggle::make('is_visible')->label('ظاهرة في الموقع')->default(true),
            ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->reorderable('sort')
            ->defaultSort('sort')
            ->columns([
                ImageColumn::make('image')->label('الصورة')->disk('site')->height(70),
                ImageColumn::make('before_image')->label('قبل')->disk('site')->height(70),
                TextColumn::make('service_slug')->label('الخدمة')
                    ->formatStateUsing(fn (?string $state) => Service::where('slug', $state)->value('title_ar') ?? '—'),
                TextColumn::make('caption_ar')->label('الوصف')->limit(40),
                ToggleColumn::make('is_visible')->label('ظاهرة'),
            ])
            ->filters([
                SelectFilter::make('service_slug')->label('الخدمة')->options(fn () => Service::orderBy('sort')->pluck('title_ar', 'slug')),
            ])
            ->recordActions([EditAction::make(), DeleteAction::make()]);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListGalleryItems::route('/'),
            'create' => CreateGalleryItem::route('/create'),
            'edit' => EditGalleryItem::route('/{record}/edit'),
        ];
    }
}
