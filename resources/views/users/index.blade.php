@extends('layouts.app')

@section('content')
@include('users.ranking')
<div class = 'row justify-content-center'>
    <div class = "col-sm-6 col-md-6">
        <div class = "text-center">    
        <h2 class = 'my-4 '>メンバー一覧</h2>
        @if (count ($users) > 0)
            <table class="table table-border  table-striped">
                <thead>
                    <tr>
                        <th>メンバー</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                        @if ($user->role === 2)
                            <tr>
                                <td>Ⓒ{!! link_to_route("users.show" , $user->name , ['user' => $user->id], ['class' => 'mylink']) !!}</td>
                            </tr>
                        @elseif ($user->role === 1)
                            <tr>
                                <td>☆{!! link_to_route("users.show" , $user->name , ['user' => $user->id], ['class' => 'mylink']) !!}</td>
                            </tr>
                        @else
                            <tr>
                                <td>{!! link_to_route("users.show" , $user->name , ['user' => $user->id], ['class' => 'mylink']) !!}</td>
                            </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>
        @endif
        {{ $users->links() }}
        </div>
    </div>
</div>
@endsection