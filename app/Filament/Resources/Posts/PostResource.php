<?php

namespace App\Filament\Resources\Posts;

use App\Filament\Resources\Posts\Pages\CreatePost;
use App\Filament\Resources\Posts\Pages\EditPost;
use App\Filament\Resources\Posts\Pages\ListPosts;
use App\Filament\Support\Fields;
use App\Models\Post;
use App\Models\Service;
use BackedEnum;
use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Filament\Resources\Resource;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Table;

class PostResource extends Resource
{
    protected static ?string $model = Post::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedNewspaper;

    protected static ?string $modelLabel = 'مقالة';

    protected static ?string $pluralModelLabel = 'المدونة';

    protected static ?int $navigationSort = 6;

    protected static ?string $recordTitleAttribute = 'title_ar';

    public static function form(Schema $schema): Schema
    {
        return $schema->columns(1)->components([
            Section::make('المحتوى')->schema([
                Fields::text('title', 'العنوان', true),
                Fields::textarea('excerpt', 'ملخص قصير', false, 2),
                Fields::textarea('body', 'نص المقالة', true, 12, 'افصل بين كل فقرة والتانية بسطر فاضي'),
            ]),
            Section::make('الإعدادات')->schema([
                Grid::make(2)->schema([
                    Fields::slug(),
                    DatePicker::make('published_at')->label('تاريخ النشر')->required()->default(now()),
                    Select::make('service_slug')->label('الخدمة المرتبطة')
                        ->options(fn () => Service::orderBy('sort')->pluck('title_ar', 'slug'))
                        ->helperText('بيظهر زرار للخدمة دي في آخر المقالة'),
                    Toggle::make('is_visible')->label('منشورة في الموقع')->default(true)->inline(false),
                ]),
            ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->defaultSort('published_at', 'desc')
            ->columns([
                TextColumn::make('title_ar')->label('العنوان')->searchable()->wrap()->weight('bold'),
                TextColumn::make('published_at')->label('التاريخ')->date('Y-m-d')->sortable(),
                ToggleColumn::make('is_visible')->label('منشورة'),
            ])
            ->recordActions([EditAction::make(), DeleteAction::make()]);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListPosts::route('/'),
            'create' => CreatePost::route('/create'),
            'edit' => EditPost::route('/{record}/edit'),
        ];
    }
}
