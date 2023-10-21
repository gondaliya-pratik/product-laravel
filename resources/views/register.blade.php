@extends('layouts.app')

@section('content')
    <div class="container">
      <div class="row">
        <h1>Register</h1>
        <div class="col-md-8">
        	<form action="{{ route('auth.store') }}" method="POST">
        		@csrf
	          <div class="mb-3">
	            <label for="name" class="form-label">Name</label>
	            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="name" placeholder="enter name">
	            @error('name')
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
              	@enderror
	          </div>
	          <div class="mb-3">
	            <label for="email" class="form-label">Email</label>
	            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" id="email" placeholder="enter email">
	            @error('email')
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
              	@enderror
	          </div>
	          <div class="mb-3">
	            <label for="password" class="form-label">Password</label>
	            <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" id="password" placeholder="enter password">
	            @error('password')
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
              	@enderror
	          </div>
  		      <div class="mb-3">
  		        <button type="submit" class="btn btn-primary">Submit</button>
  		      </div>
		  	  </form>
        </div>
      </div>
    </div>
@endsection
