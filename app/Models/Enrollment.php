<?php

namespace App\Models;

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
        'id'
    ];


}
