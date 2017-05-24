<?php

namespace App\Http\Controllers;

use App\Events\PostCreateEvent;
use App\Events\PostGroupEvent;
use App\Messages;
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
        //$user->notify(new DemoNotification());
        $message = Messages::forceCreate([
            'message' => $request->input('message'),
            'id_user' => $user->id,
            'author' => $user->id,
        ]);
        $event = new PostGroupEvent([
            'message' => $request->input('message'),
            'created_at' =>$message->created_at
        ])    ;
        broadcast($event)->toOthers();
        return ['message envoyé'];
    }

    public function getMsg($id)
    {
        return Messages::where('author',$id)->get();
    }

    public function muta()
    {
        $messages = Messages::where('author',1)->get();
        foreach ($messages as $index => $message) {
            dump($message->created_at);
            dump($message->created_at_year);
            dump($message->getOriginal('created_at'));
            dump($message->updated_at);
            dump($message);
        }

        dump($messages);
        die();
    }

    public function errors()
    {
        return view('error');
    }
}
