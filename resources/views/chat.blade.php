@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-12 " >
            <h1>Hello {{Auth::user()->name}}</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-12 btn btn-primary" @click="notify">Send</div>
    </div>
    <br>
    <hr>
    <div class="row border">
        <div class="col-12">
            <h1>hello world</h1>
        </div>
    </div>
    <hr>

    <div class="row">
        <div class="col-12 card-danger text-white"
             v-if="message"
             @click="clearMessage"
        >
            <a href="">@{{ message }}</a>
        </div>
        <div class="col-12 " v-else>Pas de nouveau message</div>
    </div>
@endsection