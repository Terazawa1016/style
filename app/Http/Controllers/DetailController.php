<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Style;
use App\Like;
use App\View;
use App\Chat;
use Carbon\Carbon;
use Auth;

class DetailController extends Controller
{
  public function __construct()
  {
      $this->middleware('auth');
  }

  public function detail($style_id)
  {
    // ユーザのお気に入り追加合計値
    $count_like = User::find(
      Auth::id()
    )->like()->sum('count');

    $item = Style::with(['Like'=>function($q) {
      $q->where('user_id',Auth::id());
    }])->where([
      'id'=>$style_id
    ])->first();

    // 現在ページのjob_idから主催者のidデータを取得
    $chat = Chat::whereHas('Style', function($query) use ($style_id) {
      $query->where('id', $style_id);
    })->orderBy('id', 'desc')->get();

    $session = session('visited') ? session('visited'):[];
    if(array_search($style_id,$session) === false) {

      $view = new View;
      $view_stamp = $view->where([
        'style_id'=>$style_id,
        'user_id'=>Auth::id()
      ])->first();
      if(empty($view_stamp)){
        $view->style_id = $style_id;
        $view->user_id = Auth::id();
        $view->today = Carbon::now();
        $view->count=1;
        $view->save();
      } else {
        $view_stamp->count += 1;
        $view_stamp->today = Carbon::now();
        $view_stamp->save();
      }

      if(!session()->has('visited')) {
        session(['visited'=>[$style_id]]);
        } else {
        $visited = session('visited');
        $visited[] = $style_id;
        session(['visited' => $visited] );
      }
    }

    $count_favorite = Like::where([
      'style_id'=>$style_id
    ])->sum('count');

    // dd($hash);

    return view('top.detail',compact('item', 'chat', 'count_favorite', 'count_like'));
  }

  public function like_two(Request $request)
  {

  // 商品のお気に入り追加処理
    $input = $request->all();
    $input['user_id'] = Auth::id();
    unset($input['_token']);

// dd($input);
    $like =  Like::where([
      'user_id'=>$input['user_id'],
      'style_id'=>$input['id']
      ])->first();
  // dd($input);

    if($like) {

      $like->delete();
    } else {
      $like = new Like;
      $input['style_id'] = $input['id'];
      $like->fill($input);
      $like->count = 1;
      $like->save();
    }

    return redirect()->route('detail',[
      'style_id' => $input['id']]);
  }



}
