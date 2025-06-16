<?php

namespace App\Http\Controllers;

use App\Http\Requests\IntentionRequest;
use App\Http\Resources\IntentionResource;
use App\Models\Intention;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use App\Traits\ApiResponse;
use Symfony\Component\HttpFoundation\Response as SymfonyResponse;
// use Log;

class IntentionController extends Controller
{
  use ApiResponse;

  public function createIntention(IntentionRequest $request): JsonResponse
  {
    [$hour, $min] = explode(':', $request->validated('mass_hour'));

    $intention = Intention::create([
      'mass_date' => Carbon::parse($request->validated('mass_date'))->setHours((int) $hour)->setMinutes((int) $min)->setSeconds(0),
      'contents' => $request->validated('contents'),
      'user_id' => auth()->id(),
      'church_id' => $request->validated('church_id')
    ]);

    return $this->successResponse(
      new IntentionResource($intention),
      'Intenção registrada!',
      SymfonyResponse::HTTP_CREATED
    );
  }

  public function listIntentions(): JsonResponse
  {
    $intentions = Intention::with(['church', 'user'])->get()->groupBy(function ($intention) {
      return $intention->mass_date;
    });

    return $this->successResponse(
      $intentions->map(function ($group) {
        return IntentionResource::collection($group);
      }),
      'Intenções listadas!',
      SymfonyResponse::HTTP_OK
    );
  }
}
