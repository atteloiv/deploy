<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Filters\PostFilter;
use App\Http\Requests\FilterRequest;
use App\Models\Post;
use App\Http\Resources\Post\PostIndexResource;


class FilterController extends Controller
{
    public function search(FilterRequest $request)
    {
        $data = $request->validated();

        $filter = app()->make(PostFilter::class, ['queryParams' => array_filter($data)]);
        $posts = Post::filter($filter)->get();
        return PostIndexResource::collection(Post::filter($filter)->get());
    }


}
