<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Carbon\Carbon;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public function render()
    {
        return Inertia::render('Dashboard', $this->getProps());
    }

    private function getProps()
    {
        $props = ['monitors' => [
            'users' => [
            'users_count' => $this->getUsersCount(),
            'last_signups' => $this->getLastSignups(),
            ],
            'courses' => [
            'courses_count' => ''
            ]
        ]];


        return $props;
    }

    private function getUsersCount()
    {
        $allUsers = User::count();

        return $allUsers;
    }

    private function getLastSignups()
    {
       $lastWeekUsers = User::whereBetween('timecreated', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->get();

       return $lastWeekUsers;
    }
}



