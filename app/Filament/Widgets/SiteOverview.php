<?php

namespace App\Filament\Widgets;

use App\Models\Booking;
use App\Models\Service;
use App\Models\Testimonial;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class SiteOverview extends StatsOverviewWidget
{
    protected static ?int $sort = -1;

    protected function getStats(): array
    {
        return [
            Stat::make('طلبات جديدة', Booking::where('status', 'new')->count())
                ->description('طلبات لسه محدش تواصل معاها')
                ->color('warning'),
            Stat::make('طلبات آخر 30 يوم', Booking::where('created_at', '>=', now()->subDays(30))->count()),
            Stat::make('الخدمات الظاهرة', Service::where('is_visible', true)->count()),
            Stat::make('آراء العملاء', Testimonial::where('is_visible', true)->count()),
        ];
    }
}
