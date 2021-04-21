@extends('layouts.app')
@section('content')
    <div id="app">
        <div class="container mw-100">
            <div class="row">
                <div class="col-md-3">
                    <account-sidebar :menu="{{json_encode($menu)}}" :slug="{{json_encode($slug)}}"></account-sidebar>
                </div>
                <div class="col-md-9">
                    <?php if(isset($slug)){ ?>
                    <account
                        :param="{{json_encode(['slug'=>$slug,'subId'=>$subId,'auth_token'=>Auth::id()])}}"></account>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
@endsection
