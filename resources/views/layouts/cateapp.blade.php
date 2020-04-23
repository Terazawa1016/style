<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="utf-8">
  <title>Style List</title>
  <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/bxslider/4.2.12/jquery.bxslider.css"> -->
  <link rel="stylesheet" href="{{ asset('css/top.css') }}">
  <link rel="stylesheet" href="{{ asset('css/detail.css') }}">
  <link rel="stylesheet" href="{{ asset('css/category.css') }}"/>

  <link href="https://fonts.googleapis.com/css?family=Quicksand" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css" rel="stylesheet" crossorigin="anonymous">


</head>
<body>
  <header>
    <div class="header-box">

      <a href="{{route('home')}}">
        <img class="logo" src="/storage/images/logo.png" alt="Style LIST">
      </a>
      <div class="header-shop">
        <nav class="header-menu">
          <ul class="header-list" id="menu">
            <li><a href=""><i class="jobs fas fa-bars"></i></a>
                 <ul>
                   <li>
                     <form id="form4" action="{{route('category')}}" method="get">
                       <input id="sbox4"  id="s" name="s" type="text" placeholder="search-style" />
                       <button id="sbtn4" type="submit"><i class="fas fa-search"></i></button>
                     </form>
                   </li>
                   <li><a href="{{route('content')}}">home</a></li>
                   <li><a href="{{route('category')}}">category</a></li>
                   <li><a href="{{route('age')}}">age</a></li>
                   <li><a href="{{route('height')}}">height</a></li>
                 </ul>
               </li>
               <li><a href=""><i class="jobs far fa-user"></i></a>
                    <ul>
                      <li>
                        <form id="form4" action="{{route('category')}}" method="get">
                          <input id="sbox4"  id="s" name="s" type="text" placeholder="search-style" />
                          <button id="sbtn4" type="submit"><i class="fas fa-search"></i></button>
                        </form>
                      </li>
                      <li><a href="{{route('tool')}}">{{Auth::user()->name}}</a></li>
                      <li><a href="{{route('favorite')}}">favorite :{{$count_like}}</a></li>
                      <li><a href="{{route('create')}}">create-style</a></li>
                      <li>
                        <form method="post" action="{{route('logout')}}">
                          @csrf
                          <input class="nemu btn btn-flat-border" type="submit" value="logout">
                        </form>
                      </li>
                    </ul>
                  </li>

             {{--<li>
               <a href="{{route('favorite')}}" class="favorite_id"><i class="jobs fas fa-heartbeat"></i></a>
             </li>--}}
          </ul>
         </nav>
      </div>
    </div>
{{--ヘッダーバー--------------------------------------------------------------}}
<div class="nav-inner">
      <ul class="left">
          <li>
            <a href="/category?category=mode">モード</a>
          </li>
          /
          <li>
            <a href="/category?category=casual">カジュアル</a>
          </li>
          /
          <li>
            <a href="/category?category=stylish">きれい目</a>
          </li>
          /
          <li>
            <a href="/category?category=street">ストリート</a>
          </li>
          /
          <li>
            <a href="/category?category=outdoor">アウトドア</a>
          </li>
          /
          <li>
            <a href="/category?category=rock">ロック</a>
          </li>
          /
          <li>
            <a href="/category?category=trad">トラッド</a>
          </li>
          /
          <li>
            <a href="/category?category=used">古着MIX</a>
          </li>
          /
          <li>
            <a href="/category?category=other">その他</a>
          </li>
      </ul>
  </div>
{{--ヘッダーバーここまで------------------------------------------------------}}
  </header>
  @yield('content')
  <footer>
    <nav>
    {{--<ul class="flex-bottom">
        <li><a href="#" target="_blank">sitemap</a></li>
        <li><a href="#" target="_blank">privacy</a></li>
        <li><a href="#" target="_blank">form</a></li>
        <li><a href="#" target="_blank">guide</a></li>
    </ul>--}}
    </nav>
    <p><small> &#169; TestUser All Rights Reserved.</small></p>
</footer>

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>

<script type="text/javascript">

$(document).ready(function() {
    $('.like_btn').click(function() {
        $(this).parent().submit();
    });
});

$(document).ready(function() {
    $('.favorite_id').click(function() {
      //自分自身の親要素(フォーム)を参照する
      //サブミットを実行
        $(this).parent().submit();
    });
});

// ----------------------------------------------------------------------------


</script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<!-- <script src="https://cdn.jsdelivr.net/bxslider/4.2.12/jquery.bxslider.min.js"></script> -->

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.js" charset="utf-8"></script>
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.css" charset="utf-8"/>
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick-theme.min.css" charset="utf-8"/>


<!-- <script type="text/javascript">
        $(document).ready(function(){
            $('.slider').slick({
              autoplay:true,
              arrows:false,
              dots:true
            });
        });
</script> -->

</body>
</html>
