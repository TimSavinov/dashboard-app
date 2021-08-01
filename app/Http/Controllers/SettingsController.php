<?php

namespace App\Http\Controllers;


use App\Models\Settings;
use \Illuminate\Http\Request;

class SettingsController extends Controller
{
    protected $settings;


    /**
     * @param Settings $settings
     *
     */
    public function __construct(Settings $settings)
    {
        $this->settings = $settings;
    }

    public function list()
    {
        return $this->settings->getAll();
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     *
     */
    public function update(Request $request)
    {
        $data = $request->validate([
            "settings.totals.users_total" => "required|array|min:3",
            "settings.totals.courses_total" => "required|array|min:3",
            "settings.totals.students_total" => "required|array|min:3",
            "settings.totals.instructors_total" => "required|array|min:3",
            "settings.chart_1" => "required|array|min:3",
            "settings.chart_2" => "required|array|min:3",
            "settings.users" => "required|array|min:3",
            "settings.instructors" => "required|array|min:3",
            "settings.courses" => "required|array|min:3",
            "settings.activities" => "required|array|min:3",
        ]);

        return $this->settings->updateMonitors($data);

        }

}



