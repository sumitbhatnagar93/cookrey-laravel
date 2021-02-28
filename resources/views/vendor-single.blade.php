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
        <single-vendor-web :slug="{{ json_encode($data) }}"></single-vendor-web>
    </div>
@endsection
