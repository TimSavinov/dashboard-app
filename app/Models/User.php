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
    public function getUsersByRole($role)
    {
        return Role::where('shortname', $role)->first()->users();
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
        return $users->filter(function($user){
            return $user['timestart'] >= Carbon::now()->startOfWeek() && $user['timestart'] <= Carbon::now()->endOfWeek();
        });
    }

    /**
     * @return mixed
     *
     */
    public function getUsersForDashboard($filtered=null)
    {
        if(!$filtered) {
            $users = User::take(6)->get(['id', 'firstname', 'lastname', 'email', 'country']);
        }
        else {
            $users = $filtered;
        }

        return $users->map(function ($user){
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
    }

    public function filterUsers ($filters)
    {

        dd($filters);

    }

    /**
     * RETURN TEACHERS WITH COURSES AND USERS IN THEM, CONSIDER TEACHERS BEING OWNERS OF COURSES BY 'mdl_user_enrolments'
     * VIA 'mdl_context' USING 'instanceid' AS  COURSE IDENTIFIER AND DEPTH AS AMOUNT OF USERS IN THE COURSE (AS THEIR
     * IDS SEEM TO BE LISTED IN 'path')
     *
     * sorted by last access
     *
     * @return mixed
     */
    public function getPopularInstructors()
    {

        // TRYING TO GET ANYTHING TEACHER-RELATED BECAUSE THERE ARE VERY FEW INSTRUCTORS BUT LOOKS BETTER IF SHOWING MORE ON DASHBOARD
        $teachers = Role::where('shortname', 'teacher')->first()->users()->take(5)->get();
        $editTeachers = Role::where('shortname', 'editingteacher')->first()->users()->take(5)->get();


        $t = $this->getInstructorsForRecents($teachers);
        $et = $this->getInstructorsForRecents($editTeachers);

        return collect(array_merge($t->toArray(), $et->toArray()))->sortBy('lastaccess')->take(5);


    }

    /**
     * @param $instructors
     * @return mixed
     *
     */
    public function getInstructorsForRecents($instructors)
    {
        return $instructors->map(function ($teacher) {
            $instructorName = $teacher->firstname . ' ' . $teacher->lastname;
            $courseList = $teacher->enrolls;
            $coursesCount = $courseList->count();
            $courseStudents = $courseList->map(function ($course) {
                $courseId = $course->courseid;
                $users = 0;
                $users += DB::table('mdl_context')->where('instanceid', '=', $courseId)->sum('depth');
                return ['users' => $users];
            });

            return ['name' => $instructorName, 'courses' => $coursesCount, 'students' => $courseStudents->sum('users')];
        });
    }

    /**
     *
     * * following the task, 'Recent Courses (4 instructors sorted by timecreated date)'
     *
     * @return mixed
     *
     */
    public function getPopularCourses()
    {

        // SAME HERE ----  TRYING TO GET ANYTHING TEACHER-RELATED BECAUSE THERE ARE VERY FEW INSTRUCTORS BUT LOOKS BETTER IF SHOWING MORE ON DASHBOARD

        $instructors = Role::where('shortname', 'coursecreator')->first()->users()->take(4)->get();
        $editTeachers = Role::where('shortname', 'editingteacher')->first()->users()->take(4)->get();
        $courseCreators = Role::where('shortname', 'coursecreator')->first()->users()->take(4)->get();

        $t = $this->coursesForRecents($instructors);
        $et = $this->coursesForRecents($editTeachers);
        $cr = $this->coursesForRecents($courseCreators);

         return collect(array_merge($t->toArray(), $et->toArray(), $cr->toArray()))->sortBy('timecreated')->take(5);
    }

    public function coursesForRecents($instr)
    {
        return $instr->map(function ($teacher) {
            $course = $teacher->enrolls->first()->courseid;
            return [
                'name' =>  Course::where('id', $course)->first()->fullname,
                'instructor' => $teacher->firstname . ' ' . $teacher->lastname,
            ];
        });
    }

    /**
     * sorting all 3 tables mentioned in the task, taking 4 the latest results, returning 'em
     *
     * @return array
     */
    public function getActivities()
    {
        $enrollments = Enrollment::latest('timecreated')->take(4)->get()->sortBy('timecreated')->map(function ($item){
            $user = User::where('id', $item->userid)->first();
            $enrol = Enroll::where('id', $item->enrolid)->first();
            return ['type' => 'enroll',
                    'ts' => $item->timecreated,
                    'user' => $user->firstname . ' ' . $user->lastname,
                    'course' => Course::where('id', $enrol->courseid)->first()->fullname,
            ];
        });

        $completions = Completion::latest('timecompleted')->take(4)->get()->sortBy('timecompleted')->map(function ($item){
            $user = User::where('id', $item->userid)->first();
            return ['type' => 'completion',
                'ts' => $item->timecompleted,
                'user' => $user->firstname . ' ' . $user->lastname,
                'course' => Course::where('id', $item->course)->first()->fullname,
            ];
        });

        $grades = Grades::latest('timecreated')->take(4)->get()->sortBy('timecreated')->map(function ($item){
            $user = User::where('id', $item->userid)->first();
            $grade = DB::table('mdl_grade_items')->where('id', $item->itemid)->first();

            return ['type' => 'grade',
                'ts' => $item->timecreated,
                'user' => $user->firstname . ' ' . $user->lastname,
                'course' => Course::where('id', $grade->courseid)->first()->fullname,
                'score' => $item->finalgrade,
            ];
        });


           $merged = array_merge($enrollments->toArray(), $completions->toArray(), $grades->toArray());

        return collect($merged)->sortByDesc('ts')->take(4)->toArray();
    }
}
