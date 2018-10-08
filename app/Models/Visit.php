<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Visit extends Model
{
    protected $primaryKey = 'visit_id';
    protected $table = 'visits';

    protected $fillable = [
        'visit_order',
        'user_id',
        'station_id',
        'finish'
    ];

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id', 'user_id');
    }

    public function patient()
    {
        return $this->belongsTo('App\Models\Patient', 'user_id', 'user_id');
    }

    public function station()
    {
        return $this->belongsTo('App\Models\Station', 'station_id', 'station_id');
    }
}