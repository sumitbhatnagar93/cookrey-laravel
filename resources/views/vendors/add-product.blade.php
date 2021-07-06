@extends('layouts.app')
@section('content')
    <div id="app">
        @if(isset($productID))
            <update-product
                :param="{{ json_encode( ['productID' => $productID, 'vendorID' => $vendorID]) }}"></update-product>
        @else
            <vendor-single-product></vendor-single-product>
        @endif
    </div>
@endsection
