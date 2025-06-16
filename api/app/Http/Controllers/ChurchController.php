<?php

namespace App\Http\Controllers;

use App\Http\Resources\ChurchResource;
use App\Models\Church;
use App\Traits\ApiResponse;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response as SymfonyResponse;

class ChurchController extends Controller
{
  use ApiResponse;

  public function listAllChurches(): JsonResponse
  {
    $churches = Church::all();
    return $this->successResponse(
      ChurchResource::collection($churches),
      'Igrejas listadas!',
      SymfonyResponse::HTTP_OK
    );
  }
}