<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <title>Sopli</title>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css">
        <link rel="stylesheet" href="{{ asset('css/index.css') }}">
    </head>

    <body>
        <div class="container-fluid">
            {{-- エラーメッセージ --}}
            
            @include('commons.navbar')
            @include('commons.error_messages')
            @yield('content')
        </div>
        
        <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
        <script src="{{ asset("js/index.js") }}"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"></script>
        <script defer src="https://use.fontawesome.com/releases/v5.7.2/js/all.js"></script>
        
    </body>
</html>