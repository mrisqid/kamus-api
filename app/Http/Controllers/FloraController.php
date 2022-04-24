<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Flora;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class FloraController extends Controller
{
  private $status_fail = 'failed';
  private $status_ok = 200;

  // Show list table data
  public function index()
  {
    $flora = DB::table('floras')->orderBy('indonesia', 'asc')->get();

    if (count($flora) > 0) {
      return response()->json([
        'status' => $this->status_ok,
        'success' => true,
        'count' => count($flora),
        'data' => $flora
      ]);
    }

    return response()->json([
      'status' => $this->status_fail,
      'success' => false,
      'message' => 'No Data!'
    ]);
  }

  // Store new row data
  public function store(Request $request)
  {
    $validator = Validator::make($request->all(), [
      'indonesia' => 'required',
      'latin' => 'required'
    ]);

    if ($validator->fails()) {
      return response()->json([
        'status' => $this->status_fail,
        'message' => 'validation_error',
        'errors' => $validator->errors()
      ]);
    }

    $data_array = array(
      'indonesia' => $request->indonesia,
      'latin' => $request->latin
    );

    $flora = Flora::create($data_array);

    if (!is_null($flora)) {
      return response()->json([
        'status' => $this->status_ok,
        'success' => true,
        'message' => 'Successfully create a new flora data!',
        'data' => $flora
      ]);
    }

    return response()->json([
      'status' => $this->status_fail,
      'success' => false,
      'message' => 'Failed to create a new flora data!'
    ]);
  }
}
