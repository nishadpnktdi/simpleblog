<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Blog;
use App\Category;
use App\Tag;

class BlogController extends Controller
{

    /**
     * Remove Auth from 'index' and 'show'.
     * 
     */
    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'show']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $blogs = Blog::get();
        return view('home')->with('blogs', $blogs);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::get();
        $tags = Tag::get();
        return view('newBlog')->with(['categories' => $categories, 'tags' => $tags]);
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
            'title' => 'required|unique:blogs',
            'author' => 'required',
            'content' => 'required',
            'category' => 'required'
        ]);

        $blog = new Blog();
        $blog->title = $request->title;
        $blog->author = $request->author;
        $blog->content = $request->content;
        $blog->category_id = $request->category;
        $blog->save();

        $blog->tags()->sync($request->tags);

        return redirect()->back()->with('message', 'Post published');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = new Blog();
        $post = $post->find($id);
        if(empty($post)){
            abort(404);
        } else {
        return view('showPost', ['post' => $post]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = new Blog();
        $post = $post->where('id', $id)->first();
        if(empty($post)){
            abort(404);
        } else {
            $categories = Category::get();
            $tags = Tag::get();
        return view('editPost', ['post' => $post, 'categories' => $categories, 'tags' => $tags]);
        }
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
            'title' => 'required',
            'author' => 'required',
            'content' => 'required',
            'category' => 'required'
        ]);

        $blog = new Blog();

        $title = $request->title;
        $author = $request->author;
        $content = $request->content;
        $category = $request->category;

        $blog->where('id', $id)->update([
            'title' => $title,
            'author' => $author,
            'content' => $content,
            'category_id' => $category
        ]);

        $blog->tags()->sync($request->tags);

        return redirect()->back()->with('message', 'Post updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = new Blog();

        $post->where('id', $id)->delete();

        return [
            'message' => 'Successfully Deleted'
        ];
    }
}
