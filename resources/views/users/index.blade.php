@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xs-12 col-sm-6 col-md-6">
                <div class="well-sm">
                    <div class="row justify-content-center">
                        <div class="col-sm-6 col-md-8 text-center">
                            <h4>{{$auth->name}} {{$auth->surname}}</h4>
                               <p><i class="glyphicon glyphicon-envelope"></i> {{$auth->email}}</p>
                            <div class="profile-userbuttons">
                                <a class="btn btn-success btn-sm" href="{{ url('show/friends') }}">Friends</a>
                                <a class="btn btn-primary btn-sm" href="{{ url('show/requests') }}">Requests</a>
                                <button id="search_click" type="button" class="btn btn-secondary btn-sm">Add Friend</button>
                            </div>
                        </div>
                    </div>
                    <div id="search" class="row hide">
                        <form action="{{ route('users.search') }}" method="GET" role="search" class="col-12">
                            {{ csrf_field() }}
                            <div id="custom-search-input">
                                <div class="input-group">
                                    <input type="search" name="search" class="search-query form-control" placeholder="Search" />
                                    <span class="input-group-btn">
                                        <button type="submit" class="btn btn-link">
                                            Search
                                        </button>
                                    </span>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
