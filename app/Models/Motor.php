<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Motor extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = ['id'];

    public static function boot()
    {
        parent::boot();

        static::created(function ($motor) {
            $motor->mtruid .= 'mtr-' . $motor->id;
            $motor->save();
        });
    }

    public function sewa()
    {
        return $this->hasMany(Sewa::class, 'sewa_id', 'id');
    }
}
