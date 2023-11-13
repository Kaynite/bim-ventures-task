<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SubCategoryRequest;
use App\Models\SubCategory;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Response;

class SubCategoryController extends Controller
{
    public function index(): AnonymousResourceCollection
    {
        return JsonResource::collection(
            SubCategory::latest('id')->paginate()
        );
    }

    public function store(SubCategoryRequest $request)
    {
        $subCategory = SubCategory::create($request->validated());

        return JsonResource::make($subCategory);
    }

    public function show(SubCategory $subCategory): JsonResource
    {
        return JsonResource::make($subCategory);
    }

    public function update(SubCategoryRequest $request, SubCategory $subCategory): JsonResource
    {
        $subCategory->update($request->validated());

        return JsonResource::make($subCategory);
    }

    public function destroy(SubCategory $subCategory): Response
    {
        $subCategory->delete();

        return response()->noContent();
    }
}
