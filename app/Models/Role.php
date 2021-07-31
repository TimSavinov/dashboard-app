<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{

    /**
     * Model table
     *
     * @var string
     */
    protected $table = 'mdl_role';

    /**
     * @var string[]
     */
    protected $guarded = [
        'timecreated'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function users()
    {
        return $this->belongsToMany(User::class, 'mdl_role_assignments', 'roleid', 'userid');
    }

}
