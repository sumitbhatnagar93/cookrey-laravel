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
        <add-service :slug="{{ json_encode($data) }}"></add-service>
    </div>

@endsection
