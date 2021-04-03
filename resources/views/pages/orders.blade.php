@extends('layouts.app')
@section('content')
    <div id="app">
        <order-receipt :order_id="{{ json_encode($orderId) }}"></order-receipt>
    </div>
@endsection
