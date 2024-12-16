<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Blog;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class BlogController extends Controller
{
    public function index()
    {
        $blogs = Blog::latest()->with('user')->paginate(6);
        return view('dashboard.blogs.index', compact('blogs'));
    }

    public function create()
    {
        return view('dashboard.blogs.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'status' => 'required|in:draft,published',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
            'meta_keywords' => 'nullable|array',
            'tags' => 'nullable|array',
            'categories' => 'nullable|array',
            'images' => 'nullable|array',
        ]);

        Blog::create([
            'title' => $request->title,
            'content' => $request->content,
            'user_id' => Auth::id(), // Get the authenticated user's ID
            'status' => $request->status,
            'meta_title' => $request->meta_title,
            'meta_description' => $request->meta_description,
            'meta_keywords' => json_encode($request->meta_keywords),
            'tags' => json_encode($request->tags),
            'categories' => json_encode($request->categories),
            'images' => json_encode($request->images),
        ]);

        return redirect()->route('blogs.index')->with('success', 'Blog created successfully!');
    }

    public function show(Blog $blog)
    {
        $blog = Blog::with('user')->findOrFail($blog->id);
        return view('dashboard.blogs.show', compact('blog'));
    }

    public function edit(Blog $blog)
    {
        return view('dashboard.blogs.edit', compact('blog'));
    }


    public function update(Request $request, Blog $blog)
    {
         // ensure the authenticated user owns the blog
          Gate::authorize('update-blog',$blog);

        $request->validate([
            'title' => 'sometimes|string|max:255',
            'content' => 'sometimes|string',
            'status' => 'sometimes|in:draft,published',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
            'meta_keywords' => 'nullable|array',
            'tags' => 'nullable|array',
            'categories' => 'nullable|array',
            'images' => 'nullable|array',
        ]);

        $blog->update([
            'title' => $request->title ?? $blog->title,
            'content' => $request->content ?? $blog->content,
            'status' => $request->status ?? $blog->status,
            'meta_title' => $request->meta_title ?? $blog->meta_title,
            'meta_description' => $request->meta_description ?? $blog->meta_description,
            'meta_keywords' => $request->has('meta_keywords') ? json_encode($request->meta_keywords) : $blog->meta_keywords,
            'tags' => $request->has('tags') ? json_encode($request->tags) : $blog->tags,
            'categories' => $request->has('categories') ? json_encode($request->categories) : $blog->categories,
            'images' => $request->has('images') ? json_encode($request->images) : $blog->images,
        ]);

        return redirect()->route('blogs.index')->with('success', 'Blog updated successfully!');
    }

    public function destroy(Blog $blog)
    {
        // ensure the authenticated user owns the blog
        Gate::authorize('delete-blog',$blog);
        $blog->delete();
        return redirect()->route('blogs.index')->with('success', 'Blog deleted successfully!');
    }
}
