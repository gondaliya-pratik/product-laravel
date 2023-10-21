@extends('layouts.app')

@section('content')
    <div class="container">
      <div class="row">
        <h2>Add Product</h2>
        <div class="col-md-8">
          <form action="{{ route('product.update',$product->id) }}" method="POST" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="mb-3">
              <label for="name" class="form-label">Product Name</label>
              <input type="text" name="name" class="form-control" id="name" placeholder="enter name" value="{{ $product->name}}">
            </div>
            <div class="mb-3">
              <label for="image" class="form-label">Image</label>
              <input type="file" name="product_image" class="form-control" id="product_image">
              <img src="{{ url($product->image_path) }}" width="150px" height="150px">
            </div>
            <div class="mb-3">
              <label for="image" class="form-label">Category</label>
              <select class="form-select" aria-label="Default select example" name="category_id">
                <option selected value="0">Select Category</option>
                @foreach($category as $item)
                  <option value="{{$item->id}}" @if($product->category_id == $item->id) selected @endif>{{$item->name}}</option>
                @endforeach
              </select>
            </div>

            <div class="mb-3">
              <label for="image" class="form-label">Sub Category</label>
              <select class="form-select" aria-label="Default select example" name="sub_category_id">
                <option selected value="0">Select Sub Category</option>
                @foreach($subcategory as $item)
                  <option value="{{$item->id}}" @if($product->sub_category_id == $item->id) selected @endif>{{$item->name}}</option>
                @endforeach
              </select>
            </div>
            <div class="mb-3">
              <label for="image" class="form-label">Status</label><br>
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="status" id="status" value="active" @if($product->status == 'active') checked @endif>
                <label class="form-check-label" for="status">Active</label>
              </div>
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="status" id="status" value="inactive" @if($product->status == 'inactive') checked @endif>
                <label class="form-check-label" for="stauts">In-Active</label>
              </div>
            </div>
            <div class="mb-3">
              <button type="submit" class="btn btn-primary">Submit</button>
            </div>
          </form>
        </div>
      </div>
    </div>
@endsection
