<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Products;
use App\Models\Category;
use App\Http\Requests\ProductRequest;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Products::with('category')->where('customer_id', Auth::id())->get();
        return view('product.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category = Category::whereNull('parent_id')->get();
        $subcategory = Category::whereNotNull('parent_id')->get();
        return view('product.add', compact('category','subcategory'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
        if($file = $request->file('product_image')) {
            $destinationPath = 'uploads/products';
            $filename = time().'_'.$file->getClientOriginalName();
            $file->move(public_path($destinationPath), $filename);
        }

        $product = Products::create([
            'customer_id' => Auth::id(),
            'name' => $request->name,
            'image_path' => $filename,
            'category_id' => $request->category_id,
            'sub_category_id' => $request->sub_category_id,
            'status' => $request->status
        ]);

        if($product) {
            dispatch(new \App\Jobs\ProductAddByCustomerJob($product));
        }

        return redirect()->route('product.index')->with('success', 'Product Added Succuessfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Products::where('id', $id)->where('customer_id', Auth::id())->first();
        $category = Category::whereNull('parent_id')->get();
        $subcategory = Category::whereNotNull('parent_id')->get();
        return view('product.edit',compact('product','category','subcategory'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $product = [
            'customer_id' => Auth::id(),
            'name' => $request->name,
            'category_id' => $request->category_id,
            'sub_category_id' => $request->sub_category_id,
            'status' => $request->status 
        ];
        if($file = $request->file('product_image')) {
            $destinationPath = 'uploads/products';
            $filename = $destinationPath.'/'.time().'_'.$file->getClientOriginalName();
            $file->move(public_path($destinationPath), $filename);
            $product['image_path'] = $filename;
        }
        Products::where('id',$id)->update($product);

        return redirect()->route('product.index')->with('success', 'Product Updated Succuessfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Products::where('id',$id)->first();
        if($product) {
            $product->delete();
        }
        return redirect()->route('product.index')->with('success', 'Product Deleted Succuessfully!');
    }
}
