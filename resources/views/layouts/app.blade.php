<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <meta name="csrf-token" content="{{csrf_token()}}">
  <title>Style List</title>
  @yield('styles')
  <link rel="stylesheet" href="{{asset('./css/app.css')}}">

  <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
  <script src="https://js.pusher.com/5.1/pusher.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/push.js/0.0.11/push.min.js"></script>

</head>
<body>
  <header>
    <nav class="my-navbar">
      <a class="my-navbar-brand" href="{{route('content')}}">
        <img class="logo" src="/storage/images/logo.png" alt="Style LIST">
      </a>
      <div class="my-navbar-control">
{{--ユーザーがログインしていればAuth::checkはtrueを返す、してなかったらfalse--}}
        @if(Auth::check())

{{--Auth::user()でログイン中のユーザーを取得する--}}
        <span class="my-navbar-item">ようこそ、{{Auth::user()->name}}さん</span>
        |
        <!-- <a href="#" id="logout" class="my-navbar-item">ログアウト</a> -->
        <form id="logout-form" action="{{route('logout')}}" method="post" style="display: none;">
          <input type="submit" value="logout">
          @csrf
        </form>
      @else
      <a class="my-navbar-item" href="{{route('login')}}">ログイン</a>
      |
      <a class-"my-navbar-item" href="{{route('register')}}">会員登録</a>
      @endif
    </div>
    </nav>
  </header>
  <main>
    @yield('content')
  </main>
  @if(Auth::check())
  <script>
    document.getElementById('logout').addEventListener('click', function(event) {
      event.preventDefault();
      document.getElementById('logout-form').submit();
    });
  </script>
  @endif
  @yield('scripts')
</body>
</html>
