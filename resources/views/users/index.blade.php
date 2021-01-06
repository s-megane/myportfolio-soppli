<div class = "row">
    <div class = "offset-xs-4 col-xs-12 col-md-12">
        <div class = "text-center">    
        <h2>メンバー一覧</h2>
        @if (count ($users) > 0)
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>メンバー</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                        @if ($user->role === 3)
                            <tr>
                                <td>{!! link_to_route("users.show" , $user->name , ['user' => $user->id]) !!}</td>
                            </tr>
                        @elseif ($user->role === 1)
                            <tr>
                                <td>☆{!! link_to_route("users.show" , $user->name , ['user' => $user->id]) !!}</td>
                            </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>
        @endif
        </div>
    </div>
</div>
