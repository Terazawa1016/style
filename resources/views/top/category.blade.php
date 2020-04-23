@extends('layouts.cateapp')

@section('content')
  <div class="content">

    {{--エラー表示--}}
    @if ($errors->any())
      <p>
        @foreach ($errors->all() as $err)
        {{$err}}<br>
        @endforeach
      </p>
    @endif
        <ul class="item-list">
      @foreach ($hash as $item)
      <li>
        <div class="item">

          {{--いいねボタン--------------------------------------------------------------}}
                        <form class="like" method="post" action="{{route('like')}}">
                          @csrf

                          @if (!empty($item->Like[0]->count))
                          <i class="like_btn fas fa-heart"></i>
                          <input type="hidden" name="id" value="{{$item['id']}}" />

                          @else
                          <i class="like_btn far fa-heart"></i>
                          <input type="hidden" name="id" value="{{$item['id']}}" />
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
   </div>
   <div style="height:100%;"></div>

@endsection
