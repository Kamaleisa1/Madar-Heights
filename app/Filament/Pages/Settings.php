<?php

namespace App\Filament\Pages;

use App\Filament\Support\Fields;
use App\Models\Service;
use App\Models\Setting;
use App\Support\SiteContent;
use BackedEnum;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;

/** General site settings: contact info, offer banner, numbers, images... */
class Settings extends Page
{
    protected string $view = 'filament.pages.settings';

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedCog6Tooth;

    protected static ?string $navigationLabel = 'إعدادات الموقع';

    protected static ?string $title = 'إعدادات الموقع';

    protected static ?int $navigationSort = 7;

    public ?array $data = [];

    public function mount(): void
    {
        $this->form->fill(Setting::find('site')?->value ?? []);
    }

    public function form(Schema $schema): Schema
    {
        $ltr = ['dir' => 'ltr'];

        return $schema->statePath('data')->components([
            Tabs::make()->persistTabInQueryString()->tabs([
                Tab::make('التواصل والشركة')->icon(Heroicon::OutlinedPhone)->schema([
                    Grid::make(3)->schema([
                        TextInput::make('phone')->label('رقم الاتصال (بالصيغة الدولية)')->required()->extraInputAttributes($ltr)->helperText('مثال: +966579255992'),
                        TextInput::make('phone_display')->label('الرقم كما يظهر للزوار')->required()->extraInputAttributes($ltr),
                        TextInput::make('whatsapp')->label('رقم الواتساب (أرقام فقط)')->required()->extraInputAttributes($ltr)->helperText('مثال: 966579255992'),
                    ]),
                    Fields::text('whatsapp_message', 'الرسالة الجاهزة في زر الواتساب'),
                    Fields::text('working_hours', 'مواعيد العمل'),
                    Grid::make(3)->schema([
                        TextInput::make('email')->label('إيميل الشركة (بيظهر في الموقع)')->email()->extraInputAttributes($ltr),
                        TextInput::make('cr_number')->label('رقم السجل التجاري')->extraInputAttributes($ltr),
                        TextInput::make('vat_number')->label('الرقم الضريبي')->extraInputAttributes($ltr),
                    ]),
                    Section::make('السوشيال ميديا')->schema([
                        Grid::make(3)->schema([
                            TextInput::make('social_facebook')->label('فيسبوك')->url()->extraInputAttributes($ltr),
                            TextInput::make('social_instagram')->label('إنستجرام')->url()->extraInputAttributes($ltr),
                            TextInput::make('social_tiktok')->label('تيك توك')->url()->extraInputAttributes($ltr),
                        ]),
                    ]),
                    Section::make('إشعارات طلبات الخدمة')->schema([
                        TagsInput::make('notify_emails')
                            ->label('الإيميلات اللي يوصلها كل طلب جديد')
                            ->placeholder('اكتب الإيميل واضغط Enter')
                            ->nestedRecursiveRules(['email']),
                    ]),
                ]),

                Tab::make('اسم الموقع والواجهة')->icon(Heroicon::OutlinedHome)->schema([
                    Fields::text('name', 'اسم الشركة', true),
                    Fields::text('tagline', 'الشعار تحت الاسم'),
                    Fields::textarea('description', 'وصف الموقع (لمحركات البحث)', false, 3),
                    Fields::tags('hero_words', 'الكلمات المتحركة في أول الصفحة'),
                    Fields::image('about_photo', 'صورة قسم "من نحن"', 'about'),
                ]),

                Tab::make('سيكشن الخصم')->icon(Heroicon::OutlinedTag)->schema([
                    Grid::make(2)->schema([
                        Toggle::make('offer_enabled')->label('إظهار سيكشن الخصم')->inline(false),
                        Select::make('offer_service')->label('الخدمة اللي عليها الخصم')
                            ->options(fn () => Service::orderBy('sort')->pluck('title_ar', 'slug')),
                    ]),
                    Grid::make(2)->schema([
                        Fields::image('offer_image_ar', 'صورة الخصم (عربي)', 'offers'),
                        Fields::image('offer_image_en', 'صورة الخصم (English)', 'offers'),
                    ]),
                    Fields::text('offer_title', 'عنوان العرض (بيظهر لو مفيش صورة)'),
                    Fields::text('offer_text', 'وصف العرض'),
                    Fields::text('offer_badge', 'علامة العرض (مثال: خصم 20%)'),
                ]),

                Tab::make('الأرقام')->icon(Heroicon::OutlinedChartBar)->schema([
                    Repeater::make('stats')->label('مربع الأرقام')->reorderable()->schema([
                        Grid::make(5)->schema([
                            TextInput::make('value')->label('الرقم')->numeric(),
                            Select::make('count')->label('أو احسبه تلقائياً')->options(['services' => 'عدد الخدمات', 'cities' => 'عدد المدن'])->placeholder('لا'),
                            TextInput::make('suffix')->label('بعد الرقم')->placeholder('+ أو %'),
                            TextInput::make('label_ar')->label('الوصف (عربي)')->required(),
                            TextInput::make('label_en')->label('الوصف (English)')->extraInputAttributes(['dir' => 'ltr']),
                        ]),
                    ])->defaultItems(0)->addActionLabel('إضافة رقم'),
                ]),

                Tab::make('لماذا نحن')->icon(Heroicon::OutlinedStar)->schema([
                    Repeater::make('why')->label('النقاط')->reorderable()->collapsible()->schema([
                        Fields::iconSelect(),
                        Fields::text('title', 'العنوان', true),
                        Fields::textarea('text', 'الوصف', false, 2),
                    ])->itemLabel(fn (array $state) => $state['title_ar'] ?? null)->addActionLabel('إضافة نقطة'),
                ]),

                Tab::make('خطوات العمل')->icon(Heroicon::OutlinedListBullet)->schema([
                    Repeater::make('steps')->label('الخطوات')->reorderable()->collapsible()->schema([
                        Fields::text('title', 'العنوان', true),
                        Fields::textarea('text', 'الوصف', false, 2),
                    ])->itemLabel(fn (array $state) => $state['title_ar'] ?? null)->addActionLabel('إضافة خطوة'),
                ]),
            ]),
        ]);
    }

    public function save(): void
    {
        $data = $this->form->getState();
        $current = Setting::find('site')?->value ?? [];

        Setting::updateOrCreate(['key' => 'site'], ['value' => array_merge($current, $data)]);
        SiteContent::flush();

        Notification::make()->title('تم الحفظ، والتعديلات ظهرت في الموقع')->success()->send();
    }
}
