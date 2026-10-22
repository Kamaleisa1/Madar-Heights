<?php

namespace App\Models;

use App\Models\Concerns\ClearsSiteCache;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use ClearsSiteCache;

    protected $primaryKey = 'key';

    public $incrementing = false;

    protected $keyType = 'string';

    protected $guarded = [];

    protected $casts = ['value' => 'array'];

    /** All settings as [key => value]. */
    public static function allValues(): array
    {
        return static::query()->get()->mapWithKeys(fn (Setting $s) => [$s->key => $s->value])->all();
    }
}
