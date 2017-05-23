<?php

namespace App\Http\Controllers;

use App\Events\PostCreateEvent;
use App\Events\PostGroupEvent;
use App\Notifications\DemoNotification;
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
        $event = new PostCreateEvent(['titre' => 'lolilol'])    ;
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
        $user->notify(new DemoNotification());

    }

    public function notifiUser()
    {
        $user = Auth::user();
        $user->notify(new DemoNotification());
    }

    public function postGroup(Request $request)
    {
        $this->validate($request, [
            'message' => 'required'
        ]);
        $user = Auth::user();
        $user->notify(new DemoNotification());
        $event = new PostGroupEvent(['message' => $request->input('message')])    ;
        broadcast($event)->toOthers();
        return ['message envoyé'];
    }

    public function errors()
    {
        return view('error');
    }
}
