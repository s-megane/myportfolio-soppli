@extends('layouts.app')

@section('content')
    <div class="row">
        <aside class="col-sm-4">
            <h3>{{$user}}さん、チームを退会しますがよろしいでしょうか？</h3>
            {!! link_to_route("users.destroy" , "退会します！" , [] , ['class' => 'btn btn-lg btn-denger']) !!}
        </aside>
    </div>
@endsection