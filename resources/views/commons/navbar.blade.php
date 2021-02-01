<header class=" mb-4">
    <nav class="navbar navbar-expand-sm navbar-dark" style="background-color:#AA0000;">
        {{-- トップページへのリンク --}}
        @if (Auth::check())
            @if(Auth::user()->role <= 2)
                <a  href="/admin" ><img class="logo" src="{{ asset('image/サンプル画像.jpg') }}" alt="logo"></a>
            @else
                <a  href="/"><img class="logo" src="{{ asset('image/サンプル画像.jpg') }}" alt="logo"></a>
            @endif

        <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#nav-bar">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="nav-bar">
            <ul class="navbar-nav mr-auto"></ul>
            <ul class="navbar-nav">
                <li class="nav-item mr-2 navbar_category">
                    @if(Auth::user()->role <= 2)
                        <a class = 'category' href="/admin" >チーム情報</a>
                    @else
                        <a class = 'category' href="/">チーム情報</a>
                    @endif
                </li>
                    {{-- ユーザ一覧ページへのリンク --}}
                    <li class="nav-item navbar_category mr-2">{!! link_to_route('users.index', 'メンバー一覧', [], ['class' => 'category']) !!}</li>
                    <li class="nav-item dropdown navbar_category ">
                        <a href="#" class=" category dropdown-toggle " data-toggle="dropdown">{{ Auth::user()->name }}のメニュー</a>
                        <ul class="dropdown-menu dropdown-menu-right  mydropdoun">
                            {{-- ユーザ詳細ページへのリンク --}}
                            <li class=" dropdown-item mydropmenu">{!! link_to_route("users.show" , "My profile" , ["user" => Auth::id()],['class' => 'mydropmenu']) !!}</li>
                            <li class="dropdown-divider"></li>
                            {{-- お気に入り一覧のリンク --}}
                            <li class="dropdown-item mydropmenu">{!! link_to_route('logout.get', 'ログアウト',[] , ['class' => 'mydropmenu']) !!}</li>
                            <li class="dropdown-divider"></li>
                            {{-- ログアウトへのリンク --}}
                            <li class="dropdown-item mydropmenu">{!! link_to_route('user.delete', '退部手続きへ',[Auth::id()], ['class' => 'mydropmenu']) !!}</li>
                            
                        </ul>
                    </li>
                @else
                    <a class="navbar-brand" href="/"><img class="logo" src="{{ asset('image/サンプル画像.jpg') }}" alt="logo"></a>
                <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#nav-bar">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="nav-bar">
                <ul class="navbar-nav mr-auto"></ul>
                <ul class="navbar-nav">
                    {{-- ユーザ登録ページへのリンク --}}
                    <li class = 'navbar_category mr-2'>{!! link_to_route('signup.get', 'メンバー登録', [], ['class' => 'category']) !!}</li>
                    {{-- ログインページへのリンク --}}
                    <li class = 'navbar_category'>{!! link_to_route('login', 'ログイン', [], ['class' => 'category']) !!}</li>
                </ul>
            @endif
            </ul>
        </div>
    </nav>
   
</header>
