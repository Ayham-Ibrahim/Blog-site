<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;
use App\Http\Requests\BlogRequest;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use App\Http\Traits\FileStorageTrait;
use App\Http\Requests\UpdateBlogRequest;

class BlogController extends Controller
{
    use FileStorageTrait;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $blogs = Blog::paginate(10);
        return view('welcome',['blogs'=>$blogs]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('blogs.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BlogRequest $request)
    {
        $data = $request->validated();
        $blog = Blog::create([
            'title' => $data['title'],
            'content' => $data['content'],
            'photo' => $this->storeFile($data['photo'], 'blogs'),
        ]);
        return redirect()->route('home')->with('sucsses','your blog has been added successfuly');
    }

    /**
     * Display the specified resource.
     */
    public function show(Blog $blog)
    {
        $blog->load('comments.user');
        return view('blogs.show',['blog' => $blog]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Blog $blog)
    {
        return view('blogs.edit',['blog' => $blog]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBlogRequest $request, Blog $blog)
    {
        $data = $request->validated();
        $blog->title = $data['title'] ?? $blog->title;
        $blog->content = $data['content'] ?? $blog->content;
        $blog->photo = $this->fileExists($data['photo'], 'blogs') ?? $blog->photo;
        $blog->save();
        return redirect()->route('home')->with('sucsses','your blog has been updated successfuly');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Blog $blog)
    {
        $blog->delete();
        return redirect()->route('home')->with('del','your blog has been deleted successfully');
    }

    /**
     *  show the deleted blog
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function deletedblog(){
        $blogs = Blog::onlyTrashed()->get();
        return view('blogs.show-deleted',compact('blogs'));
    }
    /**
     *  force delete the blog
     * @param Blog $blog
     * @return \Illuminate\Http\RedirectResponse
     */
    public function forcedelete(string $id)
    {
        Blog::withTrashed()->where('id', $id)->forceDelete();
        return redirect()->back()->with('del','your blog has been deleted successfully');
    }

    /**
     *  restore the deleted blog
     * @param Blog $blog
     * @return \Illuminate\Http\RedirectResponse
     */
    public function restore(string $id)
    {
        Blog::withTrashed()->where('id',$id)->restore();
        return redirect()->route('home')->with('restore','your blog has been restored successfully');
    }

    /**
     * Display the specified resource.
     */
    public function showForAll(Blog $blog){
        $blog->load('comments.user');
        return view('showForAll',['blog' => $blog]);
    }

    /**
     * find the blog that you want
     */
    public function search(Request $request)
    {
        $query = $request->input('query');
        $blogs = Blog::where('title', 'like', "%{$query}%")->orWhere('content', 'like', "%{$query}%")->paginate(10);
        return view('welcome', compact('blogs'));
    }
}

