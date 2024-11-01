<?php

namespace App\Http\Controllers;

use App\Models\Intention;
use Illuminate\Http\Request;
use Validator;

class IntentionController extends Controller
{
  public function index() {
    $intentions = Intention::all()->collect();

    $reducedIntentionsFormat = $intentions->reduce(function($acc, $intention) {
      $date = $intention->date;
      
      if (!isset($acc[$date])) {
        $acc[$date] = [];
      }

      $acc[$date][] = $intention;

      return $acc;
    }, []);

    return $reducedIntentionsFormat;
  }

  public function store(Request $storeIntentionRequest) {
    Validator::make($storeIntentionRequest->all(), [
      'mass_date' => 'required|date_format:d-m-Y',
      'content' => 'required|array',
      'content.*' => 'string' 
    ]);
  }
}
