@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-12 " >
            <h1>Hello {{Auth::user()->name}}</h1>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <form  @submit.prevent="notifyGroup">
                {{ csrf_field() }}
                <input type="text" name="title" v-model="title">
                <input class="btn-primary btn" type="submit" value="send">
            </form>
        </div>
        <div class="col-1" ></div>
        <div class="col-5 btn btn-primary" @click="notifyGeneral">SendGeneral</div>
    </div>
    <br>
    <hr>
    <div class="row">
        <div class="col">
            message de groupe
            <p v-if="group">@{{ group }}</p>
            <p v-else> aucun message de groupe </p>
            </div>
    </div>
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