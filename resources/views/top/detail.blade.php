<?php use Carbon\Carbon; ?>
@extends('layouts.topapp')

@section('content')

<div class="content">

  {{--@if (session('flash_message'))
      <div class="detail_flash_message">
          <p>{{ session('flash_message') }}</p>
      </div>
  @endif--}}
  <div class="detail-style">
      <div class="album">
        <a href="{{route('other', ['user_id' => $item->user_id])}}"><img class="detail-img" src = "/storage/images/{{$item->img}}"></a>
        <div class="detail-more">
          <a href="{{route('other', ['user_id' => $item->user_id])}}" class="apply-btn apply-flat-double-border">
            {{$item->User->name}}さんのコーディネートを見る
          </a>
        </div>
        <div class="detail-favorite">
          <form class="like" method="post" action="{{route('like_two')}}">
            @csrf

            @if (!empty($item->Like[0]->count))
            いいね :{{$count_favorite}} <i class="like_btn fas fa-heart"></i>
            <input type="hidden" name="id" value="{{$item['id']}}" />

            @else
            いいね :{{$count_favorite}} <i class="like_btn far fa-heart"></i>
            <input type="hidden" name="id" value="{{$item['id']}}" />
            @endif
          </form>
        </div>
      </div>


      <div class="detail-info">

        <p class="detail-name">{{$item->title}}</p><br>
        <div class="detail-user"><span class="detail-user-font">{{$item->User->name}}/{{$item->height}}cm/{{$item->category}}</span></div>
        <div class="detail-comment"><span class="detail-content">{!! nl2br(e($item->comment)) !!}</span></div>
        <div><span class="detail-date">{{Carbon::createFromFormat('Y-m-d H:i:s',$item->created_at)->format('Y年n月j日 G時i分')}}</span></div>
      </div>
  </div>




    {{--チャット画面作成--------------------------------------------------------}}

    <div id="chat">
        <div id="your_container">
          {{--エラー表示--}}
          @if ($errors->any())
            <p>
              @foreach ($errors->all() as $err)
              {{$err}}<br>
              @endforeach
            </p>
          @endif

            <!-- チャットの外側部分① -->
            <div id="bms_messages_container">
                <!-- ヘッダー部分② -->
                <div id="bms_chat_header">
                    <!--ステータス-->
                    <div id="bms_chat_user_status">
                        <!--ステータスアイコン-->
                        <div id="bms_status_icon"><i class="fas fa-user-circle"></i></div>
                        <!--ユーザー名-->
                        <div id="bms_chat_user_name">{{Auth::user()->name}}</div>
                    </div>
                </div>

                <!-- テキストボックス、送信ボタン④ -->
                <div id="bms_send">
                  <form method="post" action="{{route('chat', ['style_id' => $item->id])}}">
                    @csrf
                    <textarea id="bms_send_message" name="message"></textarea>
                      <input id="bms_send_btn" type="submit" value="送信" >
                  </form>
                </div>

                <!-- タイムライン部分③ -->
                <div id="bms_messages">

                <!--メッセージ１（左側）-->
                @foreach($chat as $message)
                @if ($message->User->id !== $item->user_id)
                <div class="bms_message bms_left">

                    <div class="bms_message_box">
                        <div class="bms_message_content">
                            <div class="bms_message_text">{{$message->User->name}}:&#010;
                              {{$message->message}}</div>
                        </div>
                    </div>
                    <div class="bms_time1">{{$message->created_at}}</div>
                </div>
                <div class="bms_clear"></div><!-- 回り込みを解除（スタイルはcssで充てる） -->
                @else
                <!--メッセージ２（右側）-->
                <div class="bms_message bms_right">

                    <div class="bms_message_box">
                        <div class="bms_message_content">
                            <div class="bms_message_text">{{$message->message}}</div>
                        </div>
                    </div>
                    <div class="bms_time2">{{$message->created_at}}</div>

                </div>
                @endif
                <div class="bms_clear"></div>
                <!-- 回り込みを解除（スタイルはcssで充てる） -->
                @endforeach

                </div>

            </div>
        </div>
      </div>

  {{--ここまで----------------------------------------------------------------}}

</div>

@endsection
