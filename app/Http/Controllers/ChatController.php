<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ChatRequest;
use Auth;
use App\Chat;

class ChatController extends Controller
{
  public function chat(ChatRequest $request, $style_id)
  {
    $input = $request->all();
    $input['style_id'] = $style_id;
    $input['user_id'] = Auth::id();
    unset($input['_token']);

  // ユーザーのメッセージを登録
    $chat_message['user_id'] = Auth::id();
    $chat_message = new Chat;
    $chat_message->fill($input);
    $chat_message->save();

    return redirect()->route('detail',[
      'style_id' => $style_id]);
  }
}
