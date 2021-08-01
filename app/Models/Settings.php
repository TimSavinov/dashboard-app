<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Settings extends Model
{

    /**
     * Model table
     *
     * @var string
     */
    protected $table = 'mdl_monitors_settings';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'sizes', 'title', 'toggle'];

    public function getAll()
    {
        $data = Settings::get(['name', 'title', 'toggle', 'sizes']);
        $res = $data->map(function ($set) {
            $name = $set['name'];
            $arr = $set->toArray();
            array_shift($arr);
            $arr['sizes'] = json_decode($arr['sizes']);
            return [ $name => $arr];
        });

        return response()->json(['settings' => $res], 200);
    }

    /**
     * @param $data
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateMonitors($data)
    {

        try {

            foreach($data['settings']['totals'] as $key => $total) {
                $total['sizes'] = json_encode($total['sizes']);
                $data_to_store = array_merge(['name' => $key], $total);
                Settings::updateOrCreate(['name' => $key], $data_to_store)->save();
            }
            array_shift($data['settings']);
            foreach($data['settings'] as $key => $value) {
                $value['sizes'] = json_encode($value['sizes']);
                $data_to_store = array_merge(['name' => $key], $value);
                Settings::updateOrCreate(['name' => $key], $data_to_store)->save();
            }

        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 422);
        }

        return response()->json(['success' => 'success'], 200);

    }

}
