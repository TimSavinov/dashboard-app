<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * Model table
     *
     * @var string
     */
    protected $table = 'mdl_user';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * @var string
     */
    private $id = '';

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * @return mixed
     */
    public function getUsersCount()
    {
        return User::count();
    }

    /**
     * @return mixed
     */
    public function getLastSignups()
    {
        return User::whereBetween('timecreated', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->get();
    }

    /**
     * @param $role
     * @return mixed
     */
    public function getUsersCountByRole($role)
    {
        return Role::where('shortname', $role)->first()->users()->count();
    }

    /**
     * @return mixed
     */
    public function getLastEnrollments()
    {
        return Enrollment::whereBetween('timestart', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->get();
    }

    /**
     * @return mixed
     */
    public function getLastByRole($r)
    {
        $users = Role::where('shortname', $r)->first()->users()->get();
        $lastEnrollments = $users->filter(function($user){
            return $user['timestart'] >= Carbon::now()->startOfWeek() && $user['timestart'] <= Carbon::now()->endOfWeek();
        });
        return $lastEnrollments;
    }
}
