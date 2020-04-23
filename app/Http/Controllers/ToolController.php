<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use App\Services\CheckExtensionServices;
use App\Services\FileUploadServices;
use App\Http\Requests\StoreRequest;

use App\User;
use Auth;
use App\Style;

class ToolController extends Controller
{
  public function __construct()
  {
      $this->middleware('auth');
  }
  public function tool(Request $request)
  {
    $count_like = User::find(
      Auth::id()
    )->like()->sum('count');

    $style_data = Style::where(
      'user_id',Auth::id()
    );

    if($request->has('s')) {
      $style_data = $style_data->where(function($query) use ($request){
        $query->where('title', 'lIKE', "%{$request->s}%");
      });
    }

    $styles = $style_data->paginate(10);

    return view('tool.tool',compact('styles', 'count_like'));
  }

  public function create()
  {
    $count_like = User::find(
      Auth::id()
    )->like()->sum('count');

    return view('tool.create', compact('count_like'));
  }

  public function store(StoreRequest $request)
  {
    $input = $request->all();
    $input['user_id'] = Auth::id();
    unset($input['_token']);

    $style = new Style;
//ファイル保存処理
    if(!is_null($request['img'])){
        $imageFile = $request['img'];

        $list = FileUploadServices::fileUpload($imageFile);
        list($extension, $fileNameToStore, $fileData) = $list;
// dd($fileNameToStore);
        $data_url = CheckExtensionServices::checkExtension($fileData, $extension);
        $image = Image::make($data_url);
        $image->resize(125,200)->save(storage_path() . '/app/public/images/' . $fileNameToStore );
        $input['img'] = $fileNameToStore;
    }

    $style->fill($input);

    $style->save();
    return redirect('/tool');

  }

  //ステータス変更処理
  public function status (Request $request, $style_id)
  {
    $input = $request->all();
    unset($input['_token']);

    $styles = Style::where('id', $style_id)->first();
    //値を部分的に更新
    $styles->fill($input);
    $styles->save();

    return redirect('/tool');
  }

  //コメント編集
  public function comment(Request $request, $style_id)
  {
    $input = $request->all();
    unset($input['_token']);

    $styles = Style::where('id', $style_id)->first();
    //値を部分的に更新
    $styles->fill($input);
    $styles->save();

    return redirect('/tool');
  }

  //削除
  public function delete(Request $request, $style_id)
  {
    Style::where('id', $style_id)
    ->delete();

    return redirect('/tool');
  }


}
