@extends('layouts.app')
@section('content')
    <div class="container">
      <div class="row">
        <h2>Add Product</h2>
        <div class="col-md-8">
          <form action="{{ url('product') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
              <label for="name" class="form-label">Product Name</label>
              <input type="text" name="name" class="form-control  @error('name') is-invalid @enderror" id="name" placeholder="enter name">
              @error('name')
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
              @enderror
            </div>
            <div class="mb-3">
              <label for="image" class="form-label">Image</label>
              <input type="file" name="product_image" class="form-control @error('product_image') is-invalid @enderror" id="product_image">
              @error('product_image')
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
              @enderror
            </div>
            <div class="mb-3">
              <label for="image" class="form-label">Category</label>
              <select class="form-select @error('category_id') is-invalid @enderror" name="category_id">
                <option selected value="">Select Category</option>
                @foreach($category as $item)
                  <option value="{{$item->id}}">{{$item->name}}</option>
                @endforeach                
              </select>
              @error('category_id')
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
              @enderror
            </div>

            <div class="mb-3">
              <label for="image" class="form-label">Sub Category</label>
              <select class="form-select @error('sub_category_id') is-invalid @enderror" name="sub_category_id">
                <option selected value="">Select Sub Category</option>
                @foreach($subcategory as $item)
                  <option value="{{$item->id}}">{{$item->name}}</option>
                @endforeach
              </select>
              @error('sub_category_id')
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
              @enderror
            </div>
            <div class="mb-3">
              <label for="image" class="form-label">Status</label><br>
              <div class="form-check form-check-inline">
                <input class="form-check-input @error('status') is-invalid @enderror" type="radio" name="status" id="status" value="active">
                <label class="form-check-label" for="status">Active</label>
              </div>
              <div class="form-check form-check-inline">
                <input class="form-check-input @error('status') is-invalid @enderror" type="radio" name="status" id="status" value="inactive">
                <label class="form-check-label" for="stauts">In-Active</label>
              </div>
              @error('status')
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
