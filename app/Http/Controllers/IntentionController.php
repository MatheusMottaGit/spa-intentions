<?php

namespace App\Http\Controllers;

use App\Models\Church;
use App\Models\Intention;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
// use Log;

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
    ], [
      'mass_date.required' => 'A data e horário da missa devem ser informados.',
      'contents.required' => 'Suas intenções devem ser informadas.'
    ]);  

    // \Illuminate\Support\Facades\Log::debug($request->all());

    if ($validator->fails()) {
      return redirect('/')->withErrors($validator);
    }

    $userId = $request->query('user_id');

    $churchId = $request->query('church_id');

    $user = User::where('id', $userId)->firstOrFail();

    [$hour, $min] = explode(':', $request->mass_hour);

    // Log::debug($request->mass_hour);

    Intention::create([
      'mass_date' => Carbon::parse($request->mass_date)->setHours((int)$hour)->setMinutes((int)$min)->setSeconds(0),
      'contents' => $request->contents,
      'user_id' => $userId,
      'church_id' => $churchId
    ]);

    if ($user->isAdmin()) {
      return redirect()->route('intentions')->with('intention-success', 'Intenção registrada!');
    }
    else{
      return redirect()->route('home')->with('intention-success', 'Intenção registrada!');
    }
  }

  public function homeView() {
    $churches = Church::all();

    return view('home', compact('churches'));
  }

  public function intentionsView() {
    $intentions = Intention::all()->groupBy(function($intention) {
      return Carbon::parse($intention->mass_date)->toDateString();
    });
    
    return view('intentions', compact('intentions'));
  }
}
