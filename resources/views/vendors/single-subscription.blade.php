@extends('layouts.app')
@section('content')

    <div id="app">
        <vendor-single-subscription
            :param="{{json_encode(['subInfo'=>$userSubscription,'userId'=>Auth::id()])}}"></vendor-single-subscription>
    </div>

@endsection
