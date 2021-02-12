@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xs-12 col-sm-offset-3 col-sm-6">
                <div class="panel panel-default">
                    <ul class="list-group" id="contact-list">
                        @foreach($requests as $key=>$value)
                            <li id="{{$value->id}}" class="list-group-item">
                                <div class="col-xs-12 col-sm-3">
                                    <img width="100" src="{{ asset('/image/user1.png') }}" class="img-responsive img-circle" />
                                </div>
                                <div class="col-xs-12 col-sm-9">
                                    <span class="name">{{$value->name}} {{$value->surname}}</span><br/>
                                    <span class="visible-xs"> <span class="text-muted">{{$value->email}}</span><br/></span>
                                </div>
                                <div class="col-xs-12 col-sm-9">
                                    <a class="btn btn-primary pull-right" href="{{ url('users/update/'.$value->id) }}">Approved</a>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                    <div class="d-flex justify-content-center">
                        {!! $requests->links() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
