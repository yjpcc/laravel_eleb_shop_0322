<?php

namespace App\Http\Controllers;

use App\Model\Activity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

class ActivityController extends Controller
{

    public function index(Request $request)
    {
            $status = $request->status;
            if ($status == 1) {
                $activitys = Activity::where('start_time', '>', date('Y-m-d H:i:s'))
                    ->paginate(10);
            } elseif ($status == 2) {
                $activitys = Activity::where('start_time', '<=', date('Y-m-d H:i:s'))
                    ->where('end_time', '>=', date('Y-m-d H:i:s'))
                    ->paginate(10);
            } else {
                $activitys = Activity::where('end_time', '>', date('Y-m-d H:i:s'))
                    ->paginate(10);
            }
        return view('activity/index', compact('activitys', 'status'));
    }

    public function show(Activity $activity)
    {
        return view('activity/show', compact('activity'));
    }
}
