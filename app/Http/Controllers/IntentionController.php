<?php

namespace App\Http\Controllers;

use App\Models\Intention;
use App\Models\User;
use Illuminate\Http\Request;
use Validator;

class IntentionController extends Controller
{
  public function readAll(Request $request) {
    $intentions = Intention::all();

    $groupedIntentions = $intentions->groupBy('mass_date');
    
    return response()->json($groupedIntentions, 200);
  }
  
  public function create(Request $request) {
    if ($request->has('contents') && is_string($request->contents)) {
      $request->merge([
        'contents' => json_decode($request->contents, true),
      ]);
    }

    $validator = Validator::make($request->all(), [
      'mass_date' => 'required|date|after_or_equal:' . now()->toDateTimeLocalString(),
      'contents' => 'required|array',
      'contents.*' => 'string'
    ]);

    if ($validator->fails()) {
      return response()->json($validator->errors(), 409);
    }

    $userId = $request->query('user_id');

    // Log::debug($userId);

    $user = User::where('id', $userId)->firstOrFail();

    Intention::create([
      'mass_date' => $request->mass_date,
      'contents' => $request->contents,
      'user_id' => $userId
    ]);

    if ($user->isAdmin()) {
      return redirect()->route('intentions')->with('success', 'Intenção registrada!');
    }
    else{
      return redirect()->route('home')->with('success', 'Intenção registrada!');
    }
  }

  public function homeView() {
    return view('home');
  }

  public function intentionsView() {
    return view('intentions');
  }
}
