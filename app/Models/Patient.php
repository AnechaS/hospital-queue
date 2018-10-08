<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Patient extends Model
{
    protected $primaryKey = 'patient_id';
    protected $table = 'patients';

    protected $fillable = [
        'firstname',
        'lastname',
        'hn',
        'dob',
        'age',
        'gender',
        'card_id',
        'user_id'
    ];

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id', 'user_id');
    }

}