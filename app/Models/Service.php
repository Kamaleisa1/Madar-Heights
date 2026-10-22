<?php

namespace App\Models;

use App\Models\Concerns\ClearsSiteCache;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use ClearsSiteCache;

    protected $guarded = [];

    protected $casts = [
        'featured' => 'boolean',
        'soon' => 'boolean',
        'is_visible' => 'boolean',
        'features_ar' => 'array',
        'features_en' => 'array',
    ];
}
