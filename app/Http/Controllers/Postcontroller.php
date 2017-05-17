<?php

namespace App\Http\Controllers;

use App\Events\PostCreateEvent;
use Illuminate\Http\Request;

class Postcontroller extends Controller
{
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
}
