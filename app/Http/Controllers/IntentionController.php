<?php

namespace App\Http\Controllers;

use App\Models\Intention;
use Illuminate\Http\Request;
use Validator;

class IntentionController extends Controller
{
  public function readAll(Request $request) {
    $intentions = Intention::all();
    return response()->json($intentions, 200);
  }
}
