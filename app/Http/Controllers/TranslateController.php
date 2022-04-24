<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stichoza\GoogleTranslate\GoogleTranslate;
use Illuminate\Support\Facades\Validator;

class TranslateController extends Controller
{
  private $status_fail = 'failed';
  private $status_ok = 200;

  public function index(Request $request)
  {

    $validator = Validator::make($request->all(), [
      'source' => 'required',
      'target' => 'required'
    ]);

    if ($validator->fails()) {
      return response()->json([
        'status' => $this->status_fail,
        'message' => 'validation_error',
        'errors' => $validator->errors()
      ]);
    }

    $text = $request->text;

    if (is_null($text)) {
      $text = '';
    }

    $translate = GoogleTranslate::trans($text, $request->target, $request->source);

    return response()->json([
      'status' => $this->status_ok,
      'translate' => $translate
    ]);
  }
}
