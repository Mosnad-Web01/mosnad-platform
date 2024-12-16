<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Blog;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;


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

        // Validate the request data
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'status' => 'required|string|in:draft,published',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
            'meta_keywords' => 'nullable|string',
            'tags' => 'nullable|string',
            'categories' => 'nullable|string',
            'images.*' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:10240',
        ]);

        // Process meta_keywords, tags, and categories into JSON
        $validated['meta_keywords'] = $validated['meta_keywords'] ? explode(',', $validated['meta_keywords']) : [];
        $validated['tags'] = $validated['tags'] ? explode(',', $validated['tags']) : [];
        $validated['categories'] = $validated['categories'] ? explode(',', $validated['categories']) : [];

        // Process image uploads
        $imagePaths = [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('blogs/images', 'public');
                $imagePaths[] = $path;
            }
        }
   

       // Save the blog to the database
        $blog = Blog::create([
            'title' => $validated['title'],
            'content' => $validated['content'],
            'status' => $validated['status'],
            'user_id' => auth()->id(), // Set the currently authenticated user's ID
            'meta_title' => $validated['meta_title'],
            'meta_description' => $validated['meta_description'],
            'meta_keywords' => json_encode($validated['meta_keywords']),
            'tags' => json_encode($validated['tags']),
            'categories' => json_encode($validated['categories']),
            'images' => json_encode($imagePaths),
        ]);

       // Redirect to the blogs index or show page with a success message
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
