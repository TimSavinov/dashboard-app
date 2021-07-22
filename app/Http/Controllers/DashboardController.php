<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Role;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
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
        ]];

        return $props;
    }
}



