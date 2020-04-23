@extends('layouts.toolapp')

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

        <h2 class="event_msg">情報の一覧・変更</h2>
        <table class="kakomi-maru1">
            <tr>
                <th>画像</th>
                <th>内容</th>
                <th>コメント</th>
                <th>操作</th>
            </tr>
            @if (!empty($styles))
            @foreach ($styles->all() as $item)
            <!--テーブル内表示-->
            <!--三項演算子『？』で条件分岐、指定の文字が入っているか空か-->
            <tr class = "{{(!$item->status) ? 'status_false':''}}">
                <td><img class="img_size" src = "/storage/images/{{$item->img}}"></td>
                <td class="tool name_width">
                  {{$item->title}}

                    <!--ステータス変更-->
                    <form method = "post" action="{{route('status', ['style_id' => $item->id])}}">

                      @csrf
                        @if ($item->status === 0)
                            <input class="btn4-square-little-rich" type = "submit" name ="status_button" value = "非公開→公開">
                            <!--非公開『0』を選択で背景色グレーに変更-->
                            <input type = "hidden" name = "status" value = '1' >
                        @else
                            <input class="btn-square-little-rich" type = "submit" name ="status_button" value = "公開→非公開">
                            <input type = "hidden" name = "status" value = '0' >
                        @endif
                    </form>
                </td>
                <td class="tool_comment">
                  {{$item->comment}}
                  <form method = "post" action="{{route('comment',['style_id' => $item->id])}}">
                    @csrf
                    <textarea name="comment" class="textlines2">{{old('comment')}}</textarea><br>
                    <input class="btn-square-little-rich" type = "submit" value = "変更">
                  </form>
                </td>
                <td class="tool_delete">
                    <!--削除-->
                    <form method = "post" action="{{route('delete',['style_id' => $item->id])}}">
                      @csrf
                        <input class="btn3-square-little-rich" type = "submit" value = "削除">
                    </form>
                </td>
            </tr>
            @endforeach
            @endif
        </table>
        <ul class="page">{{ $styles->links() }}</ul>
      </div>
    @endsection
