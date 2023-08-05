<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use  Illuminate\Http\Request;
use File;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::paginate(10);
        return view('index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();

        return view('create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       $request->validate([
            'image' => ['required', 'max:2028', 'image'],
            'title' => ['required', 'max:255'],
            'category_id' => ['required', 'integer'],
            'description' => ['required']
       ]);
            // $fileName = time().'_'.$request->image->getClientOriginalName();
            // $filePath = $request->image->storeAs('/images', $fileName);
            $fileName = time() . '.' . $request->image->extension();
             $request->image->storeAs('public/images', $fileName);
            
            $post = new Post();
            $post->title = $request->title;
            $post->description = $request->description;
            $post->category_id = $request->category_id;
            $post->image = $fileName;
            $post->save();
            return redirect()->route('posts.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::findOrFail($id);
        return view('show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::findOrFail($id);
        $categories = Category::all();
        return view('edit', compact('post', 'categories'));
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
          $request->validate([
            'title' => ['required', 'max:255'],
            'category_id' => ['required', 'integer'],
            'description' => ['required']
       ]);
            $post = Post::findOrFail($id);

            if($request->hasFile('image')){
                $request->validate([
                'image' => ['required', 'max:2028', 'image'],
            ]);
                $fileName = time() . '.' . $request->image->extension();
                $request->image->storeAs('public/images', $fileName);
                File::delete(public_path('storage/images/'.$post->image));
                $post->image = $fileName;

         }
            
                $post->title = $request->title;
                $post->description = $request->description;
                $post->category_id = $request->category_id;
                $post->save();
                return redirect()->route('posts.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $destroy = Post::findOrFail($id);
        $destroy->delete();
        return redirect()->route('posts.index');
    }
    public function trashed(){
        $posts = Post::onlyTrashed()->get();
        return view('trashed', compact('posts'));
    }
     public function restore($id){
        $post = Post::onlyTrashed()->findOrFail($id);
        $post->restore();
        return  redirect()->back();
    }

    public function delete($id)  {
        $post = Post::onlyTrashed()->findOrFail($id);
        File::delete(public_path('storage/images/'.$post->image));
        $post->forceDelete();
        return redirect()->back();
    }
}
