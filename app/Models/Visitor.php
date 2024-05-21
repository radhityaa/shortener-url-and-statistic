<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Visitor extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function scopeGroupByType($query, $by)
    {
        return $query->select($by . ' as name', DB::raw('count(*) as total'))
            ->groupBy($by)
            ->orderByDesc('total');
    }

    public function shortener()
    {
        return $this->belongsTo(Shortener::class);
    }
}
