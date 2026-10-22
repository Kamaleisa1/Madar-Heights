<?php

namespace App\Filament\Resources\Services;

use App\Filament\Resources\Services\Pages\CreateService;
use App\Filament\Resources\Services\Pages\EditService;
use App\Filament\Resources\Services\Pages\ListServices;
use App\Filament\Support\Fields;
use App\Models\Service;
use BackedEnum;
use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\Toggle;
use Filament\Resources\Resource;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Table;

class ServiceResource extends Resource
{
    protected static ?string $model = Service::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedWrenchScrewdriver;

    protected static ?string $modelLabel = 'خدمة';

    protected static ?string $pluralModelLabel = 'الخدمات';

    protected static ?int $navigationSort = 2;

    protected static ?string $recordTitleAttribute = 'title_ar';

    public static function form(Schema $schema): Schema
    {
        return $schema->columns(1)->components([
            Section::make('الاسم والوصف')->schema([
                Fields::text('title', 'اسم الخدمة', true),
                Fields::textarea('short', 'وصف قصير (بيظهر في الكارت)', true, 3),
                Fields::textarea('body', 'الوصف الكامل (صفحة الخدمة)', false, 6),
                Fields::tags('features', 'ماذا تشمل الخدمة'),
            ]),
            Section::make('الإعدادات')->schema([
                Grid::make(2)->schema([
                    Fields::slug(),
                    Fields::iconSelect(),
                ]),
                Grid::make(3)->schema([
                    Toggle::make('featured')->label('علامة "خدمتنا الأساسية"'),
                    Toggle::make('soon')->label('علامة "قريباً" (مش هتظهر في نموذج الطلب)'),
                    Toggle::make('is_visible')->label('ظاهرة في الموقع')->default(true),
                ]),
            ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->reorderable('sort')
            ->defaultSort('sort')
            ->columns([
                TextColumn::make('title_ar')->label('الخدمة')->searchable()->weight('bold'),
                TextColumn::make('title_en')->label('English')->toggleable(),
                IconColumn::make('featured')->label('أساسية')->boolean(),
                IconColumn::make('soon')->label('قريباً')->boolean(),
                ToggleColumn::make('is_visible')->label('ظاهرة'),
            ])
            ->recordActions([EditAction::make(), DeleteAction::make()]);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListServices::route('/'),
            'create' => CreateService::route('/create'),
            'edit' => EditService::route('/{record}/edit'),
        ];
    }
}
