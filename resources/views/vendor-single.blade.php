@extends('layouts.app')
@section('content')
    <?php
    if (isset($action)) {
        $data = $action;
    } else {
        $data = '';
    }
    ?>
    <div id="app">
        <single-vendor-web :auth_info="{{ json_encode(['vendor_id'=>$data,'auth_token'=>Auth::id(),'login_uri'=>route('login')]) }}"></single-vendor-web>
    </div>
@endsection
