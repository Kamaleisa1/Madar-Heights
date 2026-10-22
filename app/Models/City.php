<?php

namespace App\Models;

use App\Models\Concerns\ClearsSiteCache;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use ClearsSiteCache;

    protected $guarded = [];

    protected $casts = [
        'is_visible' => 'boolean',
        'districts_ar' => 'array',
        'districts_en' => 'array',
    ];
}
