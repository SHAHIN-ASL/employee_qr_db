<?php

namespace App\Http\Controllers;

use App\Models\Holidays;
use App\Models\Setting;
use Illuminate\Http\Request;
use DateTime;

class HolidayController extends Controller
{
    public function viewHolidaysInfo(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        $getAllActiveHolidays = Holidays::where(['active'=>1])->where('holiday_type','!=','weekend')->get();
        return view('holiday.holidayView',compact('getAllActiveHolidays'));
    }
    public function fixedWeeklyHolidayIndex(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        return view('holiday.fixedWeeklyHoliday');
    }
    public function ownOfficeHolidayIndex(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        return view('holiday.ownOfficeHoliday');
    }
    public function getOwnOfficeHolidayData(Request $request): \Illuminate\Http\RedirectResponse
    {

        if ($request->holiday_name[0] != null && $request->holiday_date[0] != null){
            $OwnOfficeHolidayDataSet = [];
            foreach($request->holiday_name as $key=>$val){
                $OwnOfficeHolidayDataSet[$key] = [
                    "holiday_name"=>$val,
                    "holiday_date"=>$request->holiday_date[$key],
                    "holiday_type"=>$request->holiday_type[$key],
                    "active"=>1
                ];
            }
            Holidays::insert($OwnOfficeHolidayDataSet);
        }

        return redirect()->route('holiday.view');
    }
    public function manageHolidaysInfo(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        $weekendTab = [
            "weekendOne"=> Setting::where('settings_key','first_weekend_name')->first()->value,
            "weekendTwo"=> Setting::where('settings_key','second_weekend_name')->first()->value,
        ];

        return view('holiday.manageHolidays',compact('weekendTab'));
    }
    public function getWeekendsData(Request $request): \Illuminate\Http\RedirectResponse
    {
        $cornArray = [
          "0"=>"Sun",
          "1"=>"Mon",
          "2"=>"Tue",
          "3"=>"Wed",
          "4"=>"Thu",
          "5"=>"Fri",
          "6"=>"Sat"
        ];

        if($request->weekendOne != null) {
            Setting::where('settings_key', 'first_weekend_name')->first()->update(['value'=>$request->weekendOne]);
            Setting::where('settings_key', 'first_weekend_cron_value')->first()->update(['value'=>array_search($request->weekendOne, $cornArray)]);
        }
        if ($request->weekendTwo != null){
            Setting::where('settings_key', 'second_weekend_name')->first()->update(['value'=>$request->weekendTwo]);
            Setting::where('settings_key', 'second_weekend_cron_value')->first()->update(['value'=>array_search($request->weekendTwo, $cornArray)]);
        }
        return redirect()->route('holiday.view');
    }
    public function holidayEdit($id): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        $getHolidayDetails = Holidays::where(['id'=>$id])->get();
        return view('holiday.holidayEdit',compact('getHolidayDetails'));
    }

    public function holidayUpdate(Request $request): \Illuminate\Http\RedirectResponse
    {
        Holidays::where(['id'=>$request->id])->update(['holiday_name'=>$request->holiday_name,'holiday_type'=>$request->holiday_type,'holiday_date'=>$request->holiday_date]);
        return redirect()->route('holiday.view');

    }
    public function holidayDestroy($id): \Illuminate\Http\RedirectResponse
    {
        Holidays::where(['id'=>$id])->update(['active'=>0]);
        return redirect()->route('holiday.view');
    }
}
