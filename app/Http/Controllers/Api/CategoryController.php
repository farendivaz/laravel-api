<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    /**
     * index
     *
     * @return void
     */
    public function index()
    {
        // Get all categories
        $categories = Category::all();

        // Return collection of categories as a resource
        return new CategoryResource(true, 'List Data Categories', $categories);
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
            'category_name' => 'required|string|max:255',
        ]);

        // Check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        // Create Category
        $category = Category::create([
            'category_name' => $request->category_name,
        ]);

        return new CategoryResource(true, "Category created Successfully!", $category);
    }

    /**
     * show
     *
     * @param  mixed $id
     * @return void
     */
    public function show($id)
    {
        // Find Category by id
        $category = Category::find($id);

        // Return single Category as a resource
        return new CategoryResource(true, "Category Detail Data!", $category);
    }

    /**
     * update
     *
     * @param  mixed $request
     * @param  mixed $id
     * @return void
     */
    public function update(Request $request, $id)
    {
        // Validation rules
        $validator = Validator::make($request->all(), [
            'category_name' => 'required|string|max:255',
        ]);

        // Check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        // Find Category by ID
        $category = Category::find($id);

        // Update Category
        $category->update([
            'category_name' => $request->category_name,
        ]);

        return new CategoryResource(true, 'Category Updated Successfully!', $category);
    }

    /**
     * destroy
     *
     * @param  mixed $id
     * @return void
     */
    public function destroy($id)
    {
        // Find Category by ID
        $category = Category::find($id);

        // Delete Category
        $category->delete();

        // Return response
        return new CategoryResource(true, 'Category Deleted Successfully!', null);
    }
}
