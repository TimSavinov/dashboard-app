<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Enroll extends Model
{

    /**
     * Model table
     *
     * @var string
     */
    protected $table = 'mdl_enrol';

    /**
     * @var string[]
     */
    protected $guarded = [
        'id'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function users()
    {
        return $this->belongsToMany(User::class, 'mdl_user_enrolments', 'enrolid', 'userid');
    }

    /**
     * @return mixed
     */
    public function scopeAllEnrollNames(){
        return Enroll::distinct()->get('enrol');
    }

}
