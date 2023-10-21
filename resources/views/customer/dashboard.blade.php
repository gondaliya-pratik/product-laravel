@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row">
    <h2 class="mt-5">Hello... {{Auth::user()->name}}</h2>
  </div>
</div>
@endsection
