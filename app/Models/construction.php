<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class construction extends Model
{
    protected $table='constructionn';
    public $fillable=[
        'plot_area',
        'construction_area',
        'budget',
        'location',
        'your_name',
        'contact',
    ];
}
