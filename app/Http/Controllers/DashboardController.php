<?php

namespace App\Http\Controllers;

use App\Models\Completion;
use App\Models\Course;
use App\Models\Enroll;
use App\Models\Enrollment;
use App\Models\User;
use http\Env\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;
use Illuminate\Support\Facades\Response;

class DashboardController extends Controller
{
    /**
     * @var User
     */
    protected $user;

    /**
     * @var Course
     */
    protected $course;

    /**
     * DashboardController constructor.
     * @param User $user
     * @param Course $course
     */
    public function __construct(User $user, Course $course)
    {
        $this->user = $user;
        $this->course = $course;
    }

    /**
     * @return \Inertia\Response
     */
    public function render()
    {
        return Inertia::render('Dashboard', $this->getProps());
    }

    /**
     * @return \array[][]
     */
    private function getProps()
    {
        $props = ['totals' => [
            'users' => [
                'count' => $this->user->getUsersCount(),
                'last' => $this->user->getLastSignups(),
            ],
            'courses' => [
                'count' => $this->course->getCoursesCount(),
                'last' => $this->course->getLastCourses(),
            ],
            'students' => [
                'count' => $this->user->getUsersByRole('student')->count(),
                'last' => $this->user->getLastEnrollments(),
             ],
            "teachers" => [
                'count' => $this->user->getUsersByRole('teacher')->count(),
                'last' => $this->user->getLastByRole('teacher'),
            ]
        ],

            // MIGRATED ALL CHARTS TO AN AJAX CALL

            "users" => [
                // TODO: ADD MISSING INFO AND LASTNAME
                'init' => $this->user->getUsersForDashboard()
            ],

            'recents' => [
                'instructors' => $this->user->getPopularInstructors(),
                'courses' => $this->user->getPopularCourses(),
                'activity' => $this->user->getActivities(),
            ]
        ];

        return $props;
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function getInfoForFilter()
    {
        return response()->json([
            'filter_info' => [
                'courses' => Course::allCurses(),
                'enrolls' => Enroll::allEnrollNames(),
            ],
        ]);
    }

    public function getChartsInfo()
    {
        return response()->json([
            'chart_1' => [
                "enrollments" => Enrollment::getTimeEnrolled(),
                "completions" => Completion::getTimeCompleted(),
            ],
        ]);
    }

    public function exportUsers()
    {
            $users = User::all();

            $responseHeaders = array(
                "Content-type" => "text/csv",
                "Content-Disposition" => "attachment; filename=lms_users.csv",
                "Pragma" => "no-cache",
                "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
                "Expires" => "0"
            );

            $callback = function () use ($users) {
                $header = [
                    'id','auth','confirmed','policyagreed','deleted','suspended','mnethostid','username','idnumber','firstname',
                    'lastname','email','emailstop','icq','skype','yahoo','aim','msn','phone1','phone2','institution','department','address','city',
                    'country','lang','calendartype','theme','timezone','firstaccess','lastaccess','lastlogin','currentlogin','lastip',
                    'secret','picture','url','description','descriptionformat','mailformat','maildigest','maildisplay','autosubscribe',
                    'trackforums','timecreated','timemodified','trustbitmask','imagealt','lastnamephonetic','firstnamephonetic','middlename','alternatename'
                ];

                $file = fopen('php://output', 'w');

                fputcsv($file, $header);
                foreach ($users as $user) {
                    fputcsv($file, $user->toArray());
                }

                fclose($file);
            };

            return Response::stream($callback, 200, $responseHeaders);
    }

    public function filterUsers(\Illuminate\Http\Request $request)
    {
        $data = $request->validate([
            "role" => "required|array|min:2",
            "name.*" => "required|string",
            "enroll" => "required|string|min:2",
            "status" => "required|string|min:2",
            "course" => "required|string|min:2",

        ]);

        return $this->user->filterUsers($data);
    }

    public function searchUsers(\Illuminate\Http\Request $request) {
        $data = $request->validate([
            "query" => "required|string|min:1"
        ]);

        $searchQuery = $data['query'];

        $users = User::where(DB::raw('lower(`firstname`)'), 'LIKE', '%' . strtolower($searchQuery) . '%')
            ->orWhere(DB::raw('lower(`lastname`)'), 'LIKE', '%' . strtolower($searchQuery) . '%')
            ->take(6)
            ->get();


        return response()->json(["users" => $this->user->getUsersForDashboard($users)]);
    }


}



