<?php

namespace App\Http\Controllers;

use App\Models\Completion;
use App\Models\Course;
use App\Models\Enroll;
use App\Models\Enrollment;
use App\Models\User;
use http\Client\Response;
use Inertia\Inertia;

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
                'count' => $this->user->getUsersCountByRole('student'),
                'last' => $this->user->getLastEnrollments(),
             ],
            "teachers" => [
                'count' => $this->user->getUsersCountByRole('teacher'),
                'last' => $this->user->getLastByRole('teacher'),
            ]
        ],

            // TODO: ALL CHARTS TO AJAX CALL
            "chart_1" => [
//                "enrollments" => Enrollment::getTimeEnrolled(),
                "enrollments" => '',
//                "completions" => Completion::getTimeCompleted(),
                "completions" => '',
            ],

            "users" => [
                // TODO: ADD MISSING INFO AND LASTNAME
                'init' => $this->user->getUsersForDashboard()
            ],
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
}



