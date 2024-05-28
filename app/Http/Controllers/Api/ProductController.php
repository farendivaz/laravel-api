<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    /**
     * index
     *
     * @return void
     */

    public function index()
    {
        // get all products
        $products = Product::latest()->paginate(6);

        // Return collection of products as a resource
        return new ProductResource(true, 'List Data Products', $products);
    }

    /**
     * store
     *
     * @param  mixed $request
     * @return void
     */
    public function store(Request $request)
    {
        // Validation rules
        $validator = Validator::make($request->all(), [
            'image' => 'required|image|mimes:png,jpg,jpeg,gif,svg|max:2048',
            'product_name' => 'required',
            'price' => 'required',
            'fee' => 'required',
            'description' => 'required',
            'category_id' => 'required',
        ]);

        // Check if validation fails
        if ($validator->fails()){
            return response()->json($validator->errors(), 422);
        }

        // Upload image
        $image = $request->file('image');
        $image->storeAs('public/products', $image->hashName());

        // Create Product
        $product = Product::create([
            'image' => $image->hashName(),
            'product_name' => $request->product_name,
            'price' => $request->price,
            'fee' => $request->fee,
            'description' => $request->description,
            'category_id' => $request->category_id,
        ]);

        return new ProductResource(true, "Product created Successfully!", $product);
    }

    /**
     * show
     *
     * @param  mixed $product
     * @return void
     */
    public function show($id)
    {
        // Find Product by id
        $product = Product::find($id);

        // Return single Product as a resource
        return new ProductResource(true, "Product Detail Data!", $product);
    }

    /**
     * update
     *
     * @param  mixed $request
     * @param  mixed $product
     * @return void
    */
    public function update(Request $request, $id)
    {
        //define validation rules
        $validator = Validator::make($request->all(), [
            'product_name' => 'required',
            'price' => 'required',
            'fee' => 'required',
            'description' => 'required',
            'category_id' => 'required',
        ]);

        //check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        //find product by ID
        $product = Product::find($id);

        //check if image is not empty
        if ($request->hasFile('image')) {

            //upload image
            $image = $request->file('image');
            $image->storeAs('public/products', $image->hashName());

            //delete old image
            Storage::delete('public/products/'.basename($product->image));

            //update product with new image
            $product->update([
                'image' => $image->hashName(),
                'product_name' => $request->product_name,
                'price' => $request->price,
                'fee' => $request->fee,
                'description' => $request->description,
                'category_id' => $request->category_id,
            ]);

        } else {

            //update product without image
            $product->update([
                'product_name' => $request->product_name,
                'price' => $request->price,
                'fee' => $request->fee,
                'description' => $request->description,
                'category_id' => $request->category_id,
            ]);
        }

        //return response
        return new ProductResource(true, 'Product Updated Succesfully!', $product);
    }

    /**
     * destroy
     *
     * @param  mixed $product
     * @return void
     */
    public function destroy($id)
    {

        //find product by ID
        $product = Product::find($id);

        //delete image
        Storage::delete('public/products/'.basename($product->image));

        //delete product
        $product->delete();

        //return response
        return new ProductResource(true, 'Product deleted Successfully!', null);
    }

}
