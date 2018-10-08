<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Models\Visit;
use Carbon\Carbon;

class Station extends Model
{
    protected $primaryKey = 'station_id';
    protected $table = 'stations';

    protected $fillable = [
        'station_name_th',
        'station_name_en',
        'station_description',
    ];

    public function visitTodayCount()
    {
        $visit = Visit::where('station_id', $this->station_id)->whereDate('date', Carbon::today()->toDateString());
        return $visit->count();
    }
}
