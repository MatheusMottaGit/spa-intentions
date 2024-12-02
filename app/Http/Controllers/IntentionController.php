<?php

namespace App\Http\Controllers;

use App\Models\Intention;
use Illuminate\Http\Request;
use Log;
use Validator;

class IntentionController extends Controller
{
  public function readAll(Request $request) {
    $intentions = Intention::all();

    $groupedIntentions = $intentions->groupBy('mass_date');
    
    return response()->json($groupedIntentions, 200);
  }

  public function create(Request $request) {
    $validator = Validator::make($request->all(), [
      'mass_date' => 'required|date|after_or_equal:' . now()->toDateString(),
      'contents' => 'required|array',
      'contents.*' => 'string'
    ]);

    if ($validator->fails()) {
      return response()->json($validator->errors(), 409);
    }

    $userId = $request->query('user_id');

    // Log::debug($userId);

    $intention = Intention::create([
      'mass_date' => $request->mass_date,
      'contents' => $request->contents,
      'user_id' => $userId
    ]);

    return response()->json($intention, 201);
  }

  public function home() {
    return view('home');
  }
}
