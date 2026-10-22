<?php

namespace App\Filament\Resources\Bookings;

use App\Filament\Resources\Bookings\Pages\EditBooking;
use App\Filament\Resources\Bookings\Pages\ListBookings;
use App\Models\Booking;
use BackedEnum;
use Filament\Actions\Action;
use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\SelectColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class BookingResource extends Resource
{
    protected static ?string $model = Booking::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedInboxArrowDown;

    protected static ?string $modelLabel = 'طلب خدمة';

    protected static ?string $pluralModelLabel = 'طلبات الخدمة';

    protected static ?int $navigationSort = 1;

    public static function getNavigationBadge(): ?string
    {
        $new = Booking::where('status', 'new')->count();

        return $new ? (string) $new : null;
    }

    public static function canCreate(): bool
    {
        return false;
    }

    public static function form(Schema $schema): Schema
    {
        return $schema->columns(1)->components([
            Section::make('بيانات الطلب')->schema([
                Grid::make(2)->schema([
                    TextInput::make('name')->label('الاسم')->disabled(),
                    TextInput::make('phone')->label('الجوال')->disabled()->extraInputAttributes(['dir' => 'ltr']),
                    TextInput::make('service_title')->label('الخدمة')->disabled(),
                    TextInput::make('city_name')->label('المدينة')->disabled(),
                ]),
                Textarea::make('notes')->label('ملاحظات العميل')->disabled()->rows(3),
            ]),
            Section::make('المتابعة')->schema([
                Select::make('status')->label('الحالة')->options(Booking::STATUSES)->required(),
                Textarea::make('admin_notes')->label('ملاحظات داخلية (مش بتظهر للعميل)')->rows(3),
            ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->defaultSort('created_at', 'desc')
            ->columns([
                TextColumn::make('created_at')->label('التاريخ')->dateTime('Y-m-d H:i')->sortable(),
                TextColumn::make('name')->label('الاسم')->searchable(),
                TextColumn::make('phone')->label('الجوال')->searchable()->copyable()->extraAttributes(['dir' => 'ltr']),
                TextColumn::make('service_title')->label('الخدمة')->wrap(),
                TextColumn::make('city_name')->label('المدينة'),
                TextColumn::make('notes')->label('ملاحظات')->limit(40)->toggleable(),
                SelectColumn::make('status')->label('الحالة')->options(Booking::STATUSES)->selectablePlaceholder(false),
            ])
            ->filters([
                SelectFilter::make('status')->label('الحالة')->options(Booking::STATUSES),
            ])
            ->recordActions([
                Action::make('whatsapp')
                    ->label('واتساب')
                    ->icon(Heroicon::OutlinedChatBubbleOvalLeft)
                    ->color('success')
                    ->url(fn (Booking $r) => 'https://wa.me/'.preg_replace('/\D+/', '', preg_replace('/^0/', '966', $r->phone)), true),
                EditAction::make()->label('متابعة'),
                DeleteAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListBookings::route('/'),
            'edit' => EditBooking::route('/{record}/edit'),
        ];
    }
}
