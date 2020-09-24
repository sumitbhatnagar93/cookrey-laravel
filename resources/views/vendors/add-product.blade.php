@extends('layouts.app')
@section('content')
    <div id="app">
        @if(isset($productType))
            <add-subscription-product></add-subscription-product>
        @else
            <add-product></add-product>
        @endif
    </div>
@endsection

