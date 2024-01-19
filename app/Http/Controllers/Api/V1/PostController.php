<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\PostRequest;
use App\Http\Resources\Post\PostIndexResource;
use App\Http\Resources\Post\PostShowResource;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Response;
use App\Http\Filtrs\PostFilter;
use App\Http\Requests\Post\FilterRequest;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return PostIndexResource::collection(Post::with('tags')->latest()->take(9)->inRandomOrder()->get()/*->random(9)*/);

        // $data = $request->validated();

        // $filter = app()->make(PostFilter::class, ['queryParams' => array_filter($data)]);
        // $posts = Post::filter($filter)->get();
        // //return PostIndexResource::collection($posts);
        // dd($posts);
        //return 111;

        //return Category::find(1)->posts;
        //return Post::find(2)->categories;
        //$lastsPosts = Post::with('comments')->latest()->take(9);
        //$randomPosts = $lastsPosts->reorder()->inRandomOrder()->get();
        //return PostIndexResource::collection($randomPosts);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostRequest $request)
    {
        // $data = request()/*->PostRequest;*/->validate([
        //     'title' => 'required|max:255',
        //     'description' => 'required|max:255',
        //     'content' => 'required|min:5',
        //     'category_id' => '',
        //     //'tags' => '',
        // ]);
        // $tags = $data['tags'];
        // unset($data['tags']);
        // Post::create($data);

        $created_post = Post::create($request->validated());

        // foreach ($tags as $tag) {
        //     PostTag::firstOrCreate([
        //         'tag_id' => $tag,
        //         'post_id' => $post->id,
        //     ]);
        // }

        // return new Post($data->toArray());
        return new Post($created_post->toArray());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return new PostShowResource(Post::with('category', 'comments', 'tags')->findOrFail($id));
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->delete();
        return response(null, Response::HTTP_NO_CONTENT);
    }
}
