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

class OtherController extends Controller
{
  public function __construct()
  {
      $this->middleware('auth');
  }

  public function other($user_id)
  {
    // ユーザのお気に入り追加合計値
    $count_like = User::find(
      Auth::id()
    )->like()->sum('count');

    $hash = Style::with(['Like'=>function($q) {
      $q->where('user_id',Auth::id());
    }])
    ->where([
      'user_id'=>$user_id,
      'status'=>1
      ])->orderBy('created_at', 'desc')->with('View')->paginate(12);

    // dd($hash);

    return view('top.other', compact('hash', 'count_like'));
  }

  public function like_three(Request $request)
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

    return redirect()->route('other',[
      'user_id' => $input['name_id']]);
  }

}
