@extends('layouts.app')

@section('content')
  <div class="flex-1 p-6">
    @livewire('intentions-details-table', [
      'intentionsGroup' => $intentionsGroup,
      'date' => $date
    ])
  </div>
@endsection