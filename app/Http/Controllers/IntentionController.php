<?php

namespace App\Http\Controllers;

use App\Models\Intention;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Validator;

class IntentionController extends Controller
{
  public function create(Request $request) {
    if ($request->has('contents') && is_string($request->contents)) {
      $request->merge([
        'contents' => json_decode($request->contents, true),
      ]);
    }

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

    $user = User::where('id', $userId)->firstOrFail();

    [$hour, $min] = explode(':', $request->mass_hour);

    Intention::create([
      'mass_date' => Carbon::parse($request->mass_date)->setHours((int)$hour)->setMinutes((int)$min)->setSeconds(0),
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
    $intentions = Intention::all()->groupBy(function($intention) {
      return Carbon::parse($intention->mass_date)->toDateString();
    });
    
    return view('intentions', compact('intentions'));
  }

  public function intentionsDetailsView(string $date) {
    $intentionsGroup = Intention::whereDate('mass_date', $date)->get();
    return view('intentions-details', compact('date', 'intentionsGroup'));
  }
}
