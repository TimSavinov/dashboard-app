<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Completion extends Model
{

    /**
     * Model table
     *
     * @var string
     */
    protected $table = 'mdl_course_completions';

    /**
     * @var string[]
     */
    protected $guarded = [
        'id'
    ];

    /**
     * @return mixed
     *
     * default = 2019 year by GMT timezone (more records in the DB for that date)
     */
    static public function getTimeCompleted($tart = 1546300800, $end = 1577836800)
    {

        $count = Completion::whereBetween('timecompleted', [$tart, $end])->get('timecompleted')->sortBy(function ($item) {
            return -Carbon::createFromTimestamp($item)->month;
        })->groupBy(function ($item) {
            return Carbon::createFromTimestamp($item)->format("F");
        })->map->count();

        return array_reverse($count->toArray());
    }




}
