<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EvaluationForm extends Model
{
    use HasFactory;

    protected $fillable = [
        'q1',
        'q2',
        'q3',
        'q4',
        'q5',
        'q6',
        'q7',
        'q8',
        'q9',
        'total_score',
        'severity',
        'gender',
    ];

    public function getSeverityAttribute()
    {
        $score = $this->total_score;

        if ($score >= 1 && $score <= 4) {
            return 'Minimal depression';
        } elseif ($score >= 5 && $score <= 9) {
            return 'Mild depression';
        } elseif ($score >= 10 && $score <= 14) {
            return 'Moderate depression';
        } elseif ($score >= 15 && $score <= 19) {
            return 'Moderately severe depression';
        } elseif ($score >= 20 && $score <= 27) {
            return 'Severe depression';
        }

        return 'Unknown';
    }
    // public function user(){
    //     return $this->belongsTo(User::class);
    // }
}
