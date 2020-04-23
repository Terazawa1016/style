@extends('layouts.toolapp')

@section('content')
<div class="content">
    <section class="create_event">

{{--エラー表示--}}
@if ($errors->any())
  <p>
    @foreach ($errors->all() as $err)
    {{$err}}<br>
    @endforeach
  </p>
@endif
        <h2>スタイル追加</h2>
        <form method="post" enctype="multipart/form-data" action="{{route('store')}}">
          @csrf
            <div class="create create_title"><label>スタイル名: <input type="text" name="title" value="{{old('name')}}"></label></div>
            <div class="create create_age"><label>年齢: <input type="text" name="age" value="{{old('age')}}"></label></div>
            <div class="create create_img"><label>画像: <input type="file" name="img"></div></label>
            <div class="create create_height"><label>身長: <input type="text" name="height" value="{{old('height')}}"></label></div>
            <div class="create create_status">
                ステータス:
                <select name="status">
                    <option value="0">非公開</option>
                    <option value="1">公開</option>
                </select>
            </div>
            <div class="create create_category">
              カテゴリー:
              <select name="category">
                <option title="0" value="0">----</option>
                <option value="mode" @if('mode' === old('category')) selected @endif>モード</option>
                <option value="casual" @if('casual' === old('category')) selected @endif>カジュアル</option>
                <option value="stylish" @if('stylish' === old('category')) selected @endif>きれい目</option>
                <option value="street" @if('street' === old('category')) selected @endif>ストリート</option>
                <option value="outdoor" @if('outdoor' === old('category')) selected @endif>アウトドア</option>
                <option value="rock" @if('rock' === old('category')) selected @endif>ロック</option>
                <option value="trad" @if('trad' === old('category')) selected @endif>トラッド</option>
                <option value="used" @if('used' === old('category')) selected @endif>古着MIX</option>
                <option value="other" @if('other' === old('category')) selected @endif>その他</option>
              </select>
            </div>
            <div class="create create_detail"><label>コメント: <br><textarea name="comment" class="textlines">{{old('comment')}}</textarea></label></div>
          <div class="create"><input class="btn2-square-little-rich" type="submit" value="登録する"></div>
          @csrf
        </form>
    </section>
  </div>
  @endsection
