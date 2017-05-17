<?php

namespace App\Http\Controllers;

use App\Events\PostCreateEvent;
use Illuminate\Http\Request;

class Postcontroller extends Controller
{
    public function index()
    {
        $event = new PostCreateEvent()    ;
        event ($event);
        dd();
    }
}
