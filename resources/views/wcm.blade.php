@extends('layouts.app')
@section('content')
  @auth
    <div class="d-flex flex-column justify-content-center align-items-center">
      <h1>User authenticated</h1>
      <p>ID: {{ Auth::user()->id }} </p>
      <p>Name: {{ Auth::user()->name }} </p>
      <p>Email: {{ Auth::user()->email }} </p>
    </div>
  @endauth

  @guest
    <div class="d-flex flex-column justify-content-center align-items-center">
      <h1>User not authenticated</h1>
      <p> Hi, guest! </p>
    </div>
  @endguest
@endsection
