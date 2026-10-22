<?php

namespace App\Models;

use App\Models\Concerns\ClearsSiteCache;
use Illuminate\Database\Eloquent\Model;

class UiText extends Model
{
    use ClearsSiteCache;

    protected $guarded = [];

    protected static function booted(): void
    {
        static::saving(fn (UiText $t) => $t->key_hash = sha1($t->key));
    }
}
