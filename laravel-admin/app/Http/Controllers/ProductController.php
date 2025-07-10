<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductCreateRequest;
use App\Http\Requests\productUpdateRequest;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        \Gate::authorize('view', 'products');
        $products = Product::paginate();
        return ProductResource::collection($products);
    }

    /**
     * Display the specified resource.
     */
    public function show($id): ProductResource
    {
        \Gate::authorize('view', 'products');
        $product = Product::findOrFail($id);
        return new ProductResource($product);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductCreateRequest $request)
    {
        \Gate::authorize('edit', 'products');
        $product = Product::create($request->only(['name', 'description', 'price', 'image']));
        return response(new ProductResource($product), Response::HTTP_CREATED);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(productUpdateRequest $request, $id)
    {
        \Gate::authorize('edit', 'products');
        $product = Product::findOrFail($id);
        $product->update($request->only(['name', 'description', 'price', 'image']));
         return response(new ProductResource($product), Response::HTTP_CREATED);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        \Gate::authorize('edit', 'products');
        Product::destroy($id);
        return response(null, Response::HTTP_NO_CONTENT);
    }
}
