<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Style;
use App\User;
use Auth;
use App\Like;

class SearchController extends Controller
{
  public function category(Request $request)
  {
  // ユーザのお気に入り追加合計値
    $count_like = User::find(
      Auth::id()
    )->like()->sum('count');

    // likeテーブルと結合し、その中でユーザで一致した情報飲み取得
    $styles = Style::with(['Like'=>function($q) {
      $q->where('user_id',Auth::id());
    }])->where('status', 1)->with('View');

    if($request->has('category')) {

      $styles = $styles->where([
        'category'=>$request->category
      ]);
    }

    if($request->has('s')) {
      $styles = $styles->where(function($query) use ($request){
        $query->where('title', 'lIKE', "%{$request->s}%");
      });
    }

    $hash = $styles->orderBy('created_at','desc')->paginate(12);

    return view('top.category', compact('hash', 'count_like'));
  }

  public function height(Request $request)
  {
  // ユーザのお気に入り追加合計値
    $count_like = User::find(
      Auth::id()
    )->like()->sum('count');

    // likeテーブルと結合し、その中でユーザで一致した情報飲み取得
    $styles = Style::with(['Like'=>function($q) {
      $q->where('user_id',Auth::id());
    }])->where('status', 1)->with('View');

//身長検索
    if($request->has('height')) {
      $height=$request->height;
      if($height === 'tole') {
        $styles = $styles->where(
          'height','>=','200'
        );
      } else {
        $styles = $styles->where('height','<=',$height);
      }
    }

    if($request->has('s')) {
      $styles = $styles->where(function($query) use ($request){
        $query->where('title', 'lIKE', "%{$request->s}%");
      });
    }

    $hash = $styles->orderBy('height','desc')->paginate(12);

    return view('top.height', compact('hash', 'count_like'));
  }

  public function age(Request $request)
  {
  // ユーザのお気に入り追加合計値
    $count_like = User::find(
      Auth::id()
    )->like()->sum('count');

    // likeテーブルと結合し、その中でユーザで一致した情報飲み取得
    $styles = Style::with(['Like'=>function($q) {
      $q->where('user_id',Auth::id());
    }])->where('status', 1)->with('View');

//身長検索
    if($request->has('age')) {
      $age =(int) $request->age;

      if($age === 10 ) {
        $styles = $styles->where(
          'age','<=',19
        );
      } else if($age === 60) {
        $styles = $styles->where(
          'age','>=',60
        );
      } else {
        // $styles = $styles->where(
        //   'age','>=',$age)
        //   ->where(
        //     'age','<',$age+10
        //   );
          $styles = $styles->whereBetween(
            'age',[$age,$age+9]
          );
      }

    }

    if($request->has('s')) {
      $styles = $styles->where(function($query) use ($request){
        $query->where('title', 'lIKE', "%{$request->s}%");
      });
    }

    $hash = $styles->orderBy('height','desc')->paginate(12);

    return view('top.age', compact('hash', 'count_like'));
  }
}
