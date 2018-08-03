<?php

namespace App\Http\Controllers;

use App\Model\Event;
use App\Model\EventPrize;
use Illuminate\Http\Request;

class EventPrizeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
       $eventprizes=EventPrize::where('member_id','<>',0)->paginate(10);
        return view('eventprize/index', compact('eventprizes'));
    }

}
