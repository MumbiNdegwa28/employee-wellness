<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RequestAppointment extends Model
{
    use HasFactory;

    protected $fillable = [
        'type',
        'notifiable',
        'data',
        'read_at',
    ];

    protected function casts(): array
    {
        return [
            'notifiable' => 'morphs',
            'data'=>'text',
            'read_at'=>'datetime'
            // 'password' => 'hashed',
        ];
    }
}
