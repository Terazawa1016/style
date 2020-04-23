<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\View;
use App\Style;

class ContentController extends Controller
{
  public function index() {

  $hash = Style::orderBy('id','DESC')->with('View')->take(12)->get();

  return view('content', compact('hash'));
}
}
