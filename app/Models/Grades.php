<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Grades extends Model
{

    /**
     * Model table
     *
     * @var string
     */
    protected $table = 'mdl_grade_grades';

    /**
     * @var string[]
     */
    protected $guarded = [
        'id'
    ];

}
