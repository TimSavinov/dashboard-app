<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Context extends Model
{

    /**
     * Model table
     *
     * @var string
     */
    protected $table = 'mdl_context';

    /**
     * @var string[]
     */
    protected $guarded = [
        'id'
    ];

}
