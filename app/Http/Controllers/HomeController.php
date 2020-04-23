<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Style;
use App\User;
use Auth;
use App\Like;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
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

        return view('home', compact('hash', 'count_like'));
    }

    public function like(Request $request)
    {

    // 商品のお気に入り追加処理
      $input = $request->all();
      $input['user_id'] = Auth::id();
      unset($input['_token']);

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

      return redirect('/home');
    }

    public function favorite(Request $request)
    {
      // ユーザのお気に入り追加合計値
        $count_like = User::find(
          Auth::id()
        )->like()->sum('count');

       // ユーザのお気に入り一覧
        $styles = new Style;

        $styles = $styles->whereHas('Like', function($query){
          $query->where('user_id', Auth::id())->with('View');
        });
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

        $hash = $styles->paginate(12);

      return view('top.favorite', compact('hash', 'count_like'));
    }

}
