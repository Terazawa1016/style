@extends('layouts.contentapp')

@section('content')
<div class="home_content">
  <div class="home_img">
    <div class="home slider">
        <div class="home_box" style="position: relative;">
          <a href="{{route('home')}}">
            <img src="/storage/images/content4.jpeg" alt=""  >
          <p style="position: absolute top; color:#fff">Make-Your-Style</p>
          </a>
        </div>
        <div class="home_box" style="position: relative;">
          <a href="{{route('create')}}">

          <img src="/storage/images/content2.jpeg" alt="">
          <p style="position: absolute top; color:#fff">Connect-With-Style</p>
        </a>
        </div>
        <div class="home_box" style="position: relative;">
          <a href="{{route('home')}}">
          <img src="/storage/images/content3.jpeg" alt="">
          <p style="position: absolute top; color:#fff">Spread-Your-Idea</p>
        </a>
        </div>
    </div>
  </div>
  <div class="home_explain">
  <div class="home_explain_img">
    <img src="/storage/images/content5.jpeg" alt="">
  </div>
  <div class="explain_box">
    <p class="explain_title">Concept</p>
    <p class="explain_word">
      「STYLE LIST」とは、男性を中心としたあらゆるシーンのコーディネートを紹介するサービスです。<br>
      「部屋着」「結婚式」「デート着」「H&M」「オフィスカジュアル」など、アイテム・ブランド・シーンといったさまざまな条件であなた好みの服装を見つけましょう。<br>
      メンズで定番の洋服やファッション雑貨の中から似ているコーディネートを選んで、チャットで共有しましょう。<br>
      <br>
      登録するコーディネートは、ご自身を含め「家族」、「友人」、「愛犬」などどなたのコーディネートでもアップしてください。
      あなたの紹介したコーディネートが多くの方の生活に影響を与えてくれるでしょう。<br>
    </p>
    <img src="/storage/images/content6.jpeg" alt="">
  </div>
  </div>
  <div class="list">
    <p class="list-title">Style-List</p>
    <ul class="item-list">
      @foreach ($hash as $item)
      <li>
        <div class="item">

            <a href="{{route('detail', ['style_id'=>$item->id])}}"><img class="item-img" src = "/storage/images/{{$item->img}}"></a>

            <div class="item-info">

              <span class="item-name">{{$item->title}}</span><br>
              <span class="item-price">{{$item->height}}cm</span>
              <span class="item-capacity">view:{{$item->View->count()}}</span><br>
          </div>
          <a class="cart-btn btn-flat-double-border" href="{{route('detail', ['style_id'=>$item->id])}}">詳細を見る</a>
        </div>
      </li>
      @endforeach
     </ul>
   </div>
</div>
@endsection
