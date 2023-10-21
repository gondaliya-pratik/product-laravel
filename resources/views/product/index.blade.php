@extends('layouts.app')

@section('content')
    <div class="container">
      <div class="row">
        <div class="col-md-8 mb-5">
          @if(Auth::user()->role == 'customer')
          <a class="btn btn-primary" href="{{ url('product/create') }}">Add</a>
          @endif
        </div>
        <h3>Product List</h3>
        <table class="table">
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">Name</th>
              <th scope="col">Category</th>
              <th scope="col">Status</th>
              @if(Auth::check() && Auth::user()->role == 'admin')
                <th scope="col">Action</th>
              @endif
            </tr>
          </thead>
          <tbody>
            @php $i = 1; @endphp
            @foreach($products as $product)
            <tr>
              <th scope="row">{{$i}}</th>
              <td>{{$product->name}}</td>
              <td>{{$product->category->name}}</td>
              <td>{{($product->status == 'active') ? 'Active' : 'In-Active'}}</td>
              @if(Auth::check() && Auth::user()->role == 'admin')
              <td>
                <a class="btn btn-primary" href="{{ route('product.edit',$product->id)}}">Edit</a>
                <form class="mb-1" action="{{ route('product.destroy',$product->id) }}" method="POST">
                  @csrf
                  @method('DELETE')
                  <button class="btn btn-primary">Delete</button>
                </form>
              </td>
              @endif
            </tr>
              @php $i++; @endphp
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
@endsection