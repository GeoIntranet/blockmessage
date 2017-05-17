<?php

namespace App\Http\Controllers;

use App\Events\PostCreateEvent;
use App\Events\PostGroupEvent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Postcontroller extends Controller
{

    /**
     * Postcontroller constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $event = new PostCreateEvent(['titre' => 'je suis un test'])    ;
        broadcast($event)->toOthers();
        dump ($event);
        dd();
    }

    public function tchat()
    {
        return view('chat');
    }

    public function group()
    {
        $user = Auth::user();
        $event = new PostGroupEvent(['titre' => 'je suis un message de groupe'])    ;
        broadcast($event)->toOthers();
        dump ($event);
        dd();
    }

    public function errors()
    {
        return view('error');
    }
}
