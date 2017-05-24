@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col">
            <h1>Hello {{Auth::user()->name}}</h1>
        </div>
    </div>
    <div class="row">

        <div class="col-4">
            <div class="card" >
                <div class="card-block">
                    <h4 class="card-title">Users online</h4>
                </div>

                <ul class="list-group list-group-flush" v-for="user in users">
                    <li class="list-group-item"> @{{ user.name }}</li>
                </ul>
            </div>
        </div>

        <div class="col-8">

            <div class="row">
                <div class="col">

                    <div class="card">
                        <div class="card-header">
                            Joanna Rocher
                        </div>
                        <div class="card-block">
                            <div class="row" >
                                <div class="col" v-if="messages.lenght > 0">
                                    @{{ messages }}
                                </div>
                            </div>
                            <div class="row" v-for="message in messages">
                                <div class="col"> @{{ message.created_at }} </div>
                                <div class="col"> @{{ message.message }} </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <form class="form-inline right"  @submit.prevent="sendMessage">
                                {{ csrf_field() }}
                                <input class=" col form-control mb-2 mr-sm-2 mb-sm-0" type="text" name="msg" v-model="message" @keyUp="isNotTyping"  @keyDown="isTyping">
                                <input class="btn-primary btn " type="submit" value="send" :disabled="isDisable()">
                            </form>
                            <span v-show="typing" class="help-block" style="font-style: italic;">
                                Joanna is typing...
                            </span>
                        </div>
                    </div>

                </div>
                <div class="col-1" ></div>
            </div>


        </div>

    </div>

@endsection