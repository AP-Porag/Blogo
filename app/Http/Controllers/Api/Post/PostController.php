<?php

namespace App\Http\Controllers\Api\Post;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use App\Models\Post_Tags;
use App\Models\PostTags;
use App\Models\Tag;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class PostController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::orderBy('created_at','DESC')->with('user','category','comments','tags')->paginate(10);
        return response($posts);
//        $post = Post::find($id);
//        foreach ($post->tags as $tag){
//         echo $tag->name .'</br>';
//        }

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       $categories = Category::all();
       $tags = Tag::all();
       return response(compact(['categories','tags']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $this->validate($request, [
            'name' => 'required|unique:posts,name',
            'category_id' => 'required',
            //'tags' => 'required',
            'thumbnail' => 'required|image',
            'description' => 'required',

        ]);

        $post = post::create([
            'user_id' => '1',
            'category_id' => $request->category_id,
            'name' => $request->name,
            'thumbnail' => 'image.jpg',
            'description' => $request->description,
            'slug' => Str::slug($request->name),
        ]);
        $tags = $request->tags;
        $p_tags = [];
        foreach ($tags as $tag){
            array_push($p_tags,['post_id'=>$post->id,'tag_id'=>$tag]);
        }
        //PostTags::insert($p_tags);
        $post->tags()->sync($tags);


        if ($request->has('thumbnail')) {
            $image = $request->thumbnail;
            $image_new_name = time() . '.' . $image->getClientOriginalExtension();
            $image->move('storage/post/thumbnail/', $image_new_name);
            $post->thumbnail = '/storage/post/thumbnail/' . $image_new_name;
            $post->save();
        }

        return response($post);
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
        //
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
    public function destroy($id)
    {
        //
    }
}
