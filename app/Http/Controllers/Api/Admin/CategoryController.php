<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Response;

class CategoryController extends Controller
{
    public function index(): AnonymousResourceCollection
    {
        return JsonResource::collection(
            Category::latest('id')->paginate()
        );
    }

    public function store(CategoryRequest $request)
    {
        $category = Category::create($request->validated());

        return JsonResource::make($category);
    }

    public function show(Category $category): JsonResource
    {
        return JsonResource::make($category);
    }

    public function update(CategoryRequest $request, Category $category): JsonResource
    {
        $category->update($request->validated());

        return JsonResource::make($category);
    }

    public function destroy(Category $category): Response
    {
        $category->delete();

        return response()->noContent();
    }
}
