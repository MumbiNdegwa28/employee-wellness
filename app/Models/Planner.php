<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Planner extends Model
{
    use HasFactory;

    protected $table ="Planner";
    
    protected $fillable = [
        'title', 'description', 'start_date','end_date'
    ];

    protected $dates =[
            'start_date' => 'datetime',
            'end_date' => 'datetime',
        ];
    
}
