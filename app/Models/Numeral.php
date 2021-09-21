<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Numeral extends Model
{
    use HasFactory;

    protected $fillable = [
        'number',
        'roman_numeral'
    ];

    public function scopeTopTen($query)
    {
    	return $query
	    	->groupBy('number')
	    	->orderBy(DB::raw('COUNT(number)'), 'desc')
	    	->take(10)
	    	->get();
    }
}
