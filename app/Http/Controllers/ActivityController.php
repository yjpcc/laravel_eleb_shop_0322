<?php

namespace App\Http\Controllers;

use App\Model\Activity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

class ActivityController extends Controller
{

    public function index(Request $request)
    {
        if(!Redis::get('activity')) {
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
            $content = view('activity/index', compact('activitys', 'status'));

//        $dir="activitys";
//        if(!is_dir($dir)){
//            //创建目录
//            mkdir($dir,0777,true);
//        }
            file_put_contents('activity.html', $content);
            Redis::set('activity','1');
        }
        return redirect('activity.html');
    }

    public function show(Activity $activity)
    {
        if(!Redis::get('activity_show')) {
            $content = view('activity/show', compact('activity'));
//        $dir="activitys";
//        if(!is_dir($dir)){
//            //创建目录
//            mkdir($dir,0777,true);
//        }
            file_put_contents($activity->id . '.html', $content);
            Redis::set('activity_show','1');
        }
        return redirect($activity->id.'.html');
    }
}
