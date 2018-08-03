<?php

namespace App\Http\Controllers;

use App\Model\EventMember;
use Illuminate\Http\Request;

class EventMemberController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $eventmembers=EventMember::paginate(10);
        return view('eventmember/index', compact('eventmembers'));
    }
}
