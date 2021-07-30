<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function roles()
    {
        return $this->belongsToMany(Role::class, 'mdl_role_assignments', 'userid', 'roleid');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function enrolls()
    {
        return $this->belongsToMany(Enroll::class, 'mdl_user_enrolments', 'userid', 'enrolid');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function courses()
    {
        return $this->belongsToMany(Course::class, 'mdl_course_completions', 'userid', 'course');
    }

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

    public function getUsersForDashboard()
    {
            // TODO: add atatus [after reply], progress (?)

        $users = User::take(6)->get(['id', 'firstname', 'lastname', 'email', 'country']);

        $users_to_export = $users->map(function ($user){
            $enrol = $user->enrolls->first();
            $role = $user->roles->first();
            $course = $user->courses->first();
            return [
                    'name' => $user->firstname . ' ' . $user->lastname,
                    'email' => $user->email,
                    'course' => $course ? $course->shortname : null,
                    'enroll_type' => $enrol ? $enrol->enrol : null,
                    'enroll_time' => $enrol ? $enrol->timecreated : null,
                    'status' => $course != null  ? $course->status : null,
                    'role' => $role ? $role->shortname : null,
                    'progress' => $course ? DB::table('mdl_grade_grades_history')
                        ->where('userid', '=', $user->id)
                        ->where('itemid', '=', $course->id)
                        ->first() : null
            ];
        });

        return $users_to_export;
    }
}
