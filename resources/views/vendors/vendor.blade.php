@extends('layouts.app')
@section('content')
    <div id="app">
        <div class="container mw-100">
            <div class="row">
                <div class="col-md-3">
                    <vendor-sidebar :menu="{{json_encode($menu)}}" :slug="{{json_encode($slug)}}"></vendor-sidebar>
                </div>
                <div class="col-md-9">
                    <?php if(isset($slug)){ ?>
                    <vendor
                        :param="{{json_encode(['slug'=>$slug,'unique'=>$unique,'auth_token'=>Auth::id()])}}"></vendor>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
@endsection
