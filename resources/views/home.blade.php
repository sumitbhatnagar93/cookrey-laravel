@extends('layouts.app')

@section('content')
    <home-component  :auth_info="{{json_encode(['auth_token'=>Auth::id(),'login_uri'=>route('login')])}}"></home-component>
@endsection
