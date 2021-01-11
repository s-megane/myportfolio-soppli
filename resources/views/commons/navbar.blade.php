<header class="mb-4">
    <nav class="navbar navbar-expand-sm navbar-dark bg-dark">
        {{-- トップページへのリンク --}}
        @if (Auth::check())
            @if(Auth::user()->role == 1)
                <a class="navbar-brand" href="/admin" >Soppli</a>
            @else
                <a class="navbar-brand" href="/">Soppli</a>
            @endif
        <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#nav-bar">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="nav-bar">
            <ul class="navbar-nav mr-auto"></ul>
            <ul class="navbar-nav">
                <li class="mr-2 text-left text-light bg-dark">{{Auth::user()->name}}</li>
                <li class="nav-item dropdown"></li>
                    <a href="#" class="text-light bg-dark dropdown-toggle" data-toggle="dropdown">メニュー</a>
                    <ul class="dropdown-menu dropdown-menu-right">
                        {{-- ユーザ詳細ページへのリンク --}}
                        <li class="dropdown-item">{!! link_to_route('users.show', "自分の詳細ページへ" , ["user" => Auth::id()]) !!}</li>
                        <li class="dropdown-divider"></li>
                        {{-- ログアウトへのリンク --}}
                        <li class="dropdown-item">{!! link_to_route('logout.get', 'ログアウト') !!}</li>
                        <li class="dropdown-divider"></li>
                        
                        <li class="dropdown-item">{!! link_to_route('user.delete', '退部手続きへ',[Auth::id()]) !!}</li>
                        <li class="dropdown-divider"></li>
                    </ul>
                </li>
            </ul>
        @else 
            <a class="navbar-brand" href="/">Soppli</a>
            <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#nav-bar">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="nav-bar">
            <ul class="navbar-nav mr-auto"></ul>
            <ul class="navbar-nav">
                {{-- ユーザ登録ページへのリンク --}}
                <li>{!! link_to_route('signup.get', 'メンバー登録', [], ['class' => 'nav-link']) !!}</li>
                {{-- ログインページへのリンク --}}
                <li>{!! link_to_route('login', 'ログイン', [], ['class' => 'nav-link']) !!}</li>
            </ul>
        @endif
        </div>
    </nav>
</header>