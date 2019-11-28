<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Parrain extends Model
{
    public function filleuls() {
        return $this->hasMany('App\Filleul');
    }

    public static function getAvailable() {
        $all = Parrain::withCount(['filleuls'])
                    ->where('absent', 0)
                    ->inRandomOrder()
                    ->get();

        $min = $all->min('filleuls_count');

        return $all->where('filleuls_count', $min);
    }
}
