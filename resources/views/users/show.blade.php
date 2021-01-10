@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <h1 class="border border-primary">{{ $user->name }}のプロフィール</h1>
            
            <table class="table table-border">
                <div class = "text-center">
                <tbody　class = "col-sm-4">
                    <tr>
                        <th>年齢</th>
                        <td></td>
                    </tr>
                    <tr>
                        <th>背番号</th>
                        <td>{!! $user->mynum !!}</td>
                    </tr>
                     
                </tbody>
                </div>
            </table>
           
    </div>
    @if (\Auth::user()->role ===1)
    {!! link_to_route('adminuser.edit', '権限を変更する', [$user->id], ['class' => 'btn btn-light']) !!}
    @endif
@endsection