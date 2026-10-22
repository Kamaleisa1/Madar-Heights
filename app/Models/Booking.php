<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    public const STATUSES = [
        'new' => 'جديد',
        'contacted' => 'تم التواصل',
        'done' => 'تم التنفيذ',
        'cancelled' => 'ملغي',
    ];

    protected $guarded = [];
}
