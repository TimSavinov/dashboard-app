<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Enrollment extends Model
{

    /**
     * Model table
     *
     * @var string
     */
    protected $table = 'mdl_user_enrolments';

    /**
     * @var string[]
     */
    protected $guarded = [
        'id', "timemodified"
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function users(){
        return $this->belongsToMany(User::class)->select('enrolid');
    }

    /**
     * @return mixed
     *
     * default = 2019 year by GMT timezone (more records in the DB for that date)
     */
    static public function getTimeEnrolled($tart = 1546300800, $end = 1577836800)
    {

        $count = Enrollment::whereBetween('timecreated', [$tart, $end])->get('timecreated')->sortBy(function ($item) {
            return -Carbon::createFromTimestamp($item)->month;
        })->groupBy(function ($item) {
            return Carbon::createFromTimestamp($item)->format("F");
        })->map->count();

        return array_reverse($count->toArray());
    }


}
