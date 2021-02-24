<?php
/**
 * All vendors listing on web for users
 */
?>
@extends('layouts.app')

@section('content')

    <cookrey-vendors-web
        :auth_info="{{json_encode(['auth_token'=>Auth::id(),'login_uri'=>route('login')])}}"></cookrey-vendors-web>
@endsection

