<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Course extends Model
{

    /**
     * Model table
     *
     * @var string
     */
    protected $table = 'mdl_course';

    /**
     * @var string[]
     */
    protected $guarded = [
        'id'
    ];

    /**
     * @return mixed
     */
    public function getCoursesCount()
    {
        return Course::count();
    }

    /**
     * @return mixed
     */
    public function getLastCourses()
    {
        return Course::whereBetween('timecreated', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->get();
    }

    /**
     * @return mixed
     */
    public function scopeAllCurses(){
        return Course::distinct()->get('id', 'shortname', 'status');
    }
}
