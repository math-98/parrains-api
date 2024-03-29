<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Parrain extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $casts = ['absent' => 'boolean'];

    public function filleuls()
    {
        return $this->hasMany('App\Models\Filleul');
    }

    public static function getAvailable()
    {
        $all = Parrain::withCount(['filleuls'])
                    ->where('absent', 0)
                    ->inRandomOrder()
                    ->get();

        $min = $all->min('filleuls_count');

        return $all->where('filleuls_count', $min);
    }
}
