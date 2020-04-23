<?php use Carbon\Carbon; ?>
@extends('layouts.topapp')

@section('content')
<div class="content">

{{--ユーザ関連一覧----------------------------------------------------------}}
  <ul class="item-list">
    @foreach ($hash as $item)
    <li>
      <div class="item">

        {{--いいねボタン--------------------------------------------------------------}}
                      <form class="like" method="post" action="{{route('like_three')}}">
                        @csrf

                        @if (!empty($item->Like[0]->count))
                        <i class="like_btn fas fa-heart"></i>
                        <input type="hidden" name="id" value="{{$item['id']}}" />
                        <input type="hidden" name="name_id" value="{{$item['user_id']}}" />

                        @else
                        <i class="like_btn far fa-heart"></i>
                        <input type="hidden" name="id" value="{{$item['id']}}" />
                        <input type="hidden" name="name_id" value="{{$item['user_id']}}" />

                        @endif
                      </form>
        {{--ここまで「いいね」--------------------------------------------------------}}

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
   <ul class="page">{{ $hash->links() }}</ul>

{{--ここまで------------------------------------------------------------------}}


</div>
@endsection
