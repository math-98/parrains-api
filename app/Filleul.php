<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Filleul extends Model
{
    public function parrain()
    {
        return $this->belongsTo('App\Parrain');
    }

    public static function getAvailable()
    {
        return self::doesntHave('parrain')
            ->where('absent', 0)
            ->orderBy('lastname', 'asc')
            ->orderBy('firstname', 'asc');
    }

    public static function getParrainages()
    {
        return self::has('parrain')
            ->where('absent', 0)
            ->orderBy('lastname', 'asc')
            ->orderBy('firstname', 'asc');
    }
}
