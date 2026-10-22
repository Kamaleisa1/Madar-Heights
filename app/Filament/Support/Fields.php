<?php

namespace App\Filament\Support;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Grid;

/** Small helpers so every bilingual field shows Arabic and English side by side. */
class Fields
{
    public static function text(string $name, string $label, bool $required = false): Grid
    {
        return Grid::make(2)->schema([
            TextInput::make("{$name}_ar")->label("{$label} (عربي)")->required($required)->maxLength(255),
            TextInput::make("{$name}_en")->label("{$label} (English)")->maxLength(255)->extraInputAttributes(['dir' => 'ltr']),
        ]);
    }

    public static function textarea(string $name, string $label, bool $required = false, int $rows = 3, ?string $help = null): Grid
    {
        return Grid::make(2)->schema([
            Textarea::make("{$name}_ar")->label("{$label} (عربي)")->required($required)->rows($rows)->helperText($help),
            Textarea::make("{$name}_en")->label("{$label} (English)")->rows($rows)->extraInputAttributes(['dir' => 'ltr']),
        ]);
    }

    public static function tags(string $name, string $label, ?string $help = 'اكتب البند واضغط Enter'): Grid
    {
        return Grid::make(2)->schema([
            TagsInput::make("{$name}_ar")->label("{$label} (عربي)")->helperText($help)->placeholder('أضف بند جديد')->reorderable(),
            TagsInput::make("{$name}_en")->label("{$label} (English)")->placeholder('Add item')->reorderable(),
        ]);
    }

    public static function image(string $name, string $label, string $directory): FileUpload
    {
        return FileUpload::make($name)
            ->label($label)
            ->disk('site')
            ->directory("uploads/{$directory}")
            ->image()
            ->imageEditor()
            ->maxSize(4096)
            ->helperText('صورة JPG أو PNG أو WEBP، بحد أقصى 4 ميجا');
    }

    public static function slug(): TextInput
    {
        return TextInput::make('slug')
            ->label('الرابط (بالإنجليزي)')
            ->helperText('حروف إنجليزية صغيرة وشرطة فقط، مثال: carpet-cleaning. ده اللي بيظهر في رابط الصفحة.')
            ->required()
            ->alphaDash()
            ->maxLength(100)
            ->unique(ignoreRecord: true)
            ->extraInputAttributes(['dir' => 'ltr']);
    }

    /** Icons available in the site's icon set. */
    public static function iconSelect(string $name = 'icon'): Select
    {
        $icons = [
            'sofa' => 'كنب / مفروشات', 'majlis' => 'مجلس', 'curtain' => 'ستائر', 'carpet' => 'سجاد',
            'mattress' => 'مرتبة', 'ac' => 'مكيف', 'villa' => 'فيلا', 'home' => 'منزل', 'office' => 'مكتب',
            'kitchen' => 'مطبخ', 'window' => 'نافذة', 'tank-ground' => 'خزان أرضي', 'tank-roof' => 'خزان علوي',
            'pool' => 'مسبح', 'bug' => 'حشرات', 'mosque' => 'مسجد', 'car' => 'سيارة', 'shield' => 'درع / ضمان',
            'sparkle' => 'لمعة', 'brush' => 'فرشاة', 'drop' => 'نقطة ماء', 'users' => 'فريق', 'tools' => 'معدات',
            'leaf' => 'ورقة / آمن', 'clock' => 'ساعة', 'tag' => 'سعر', 'check' => 'علامة صح', 'star' => 'نجمة',
        ];

        return Select::make($name)->label('الأيقونة')->options($icons)->searchable()->required();
    }
}
