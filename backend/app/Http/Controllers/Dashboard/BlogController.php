<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Blog;
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

        // validate the request data
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

        // process meta_keywords, tags, and categories into JSON
        $validated['meta_keywords'] = $validated['meta_keywords'] ? explode(',', $validated['meta_keywords']) : [];
        $validated['tags'] = $validated['tags'] ? explode(',', $validated['tags']) : [];
        $validated['categories'] = $validated['categories'] ? explode(',', $validated['categories']) : [];

        // process image uploads
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
            'user_id' => auth()->id(),
            'meta_title' => $validated['meta_title'],
            'meta_description' => $validated['meta_description'],
            'meta_keywords' => json_encode($validated['meta_keywords']),
            'tags' => json_encode($validated['tags']),
            'categories' => json_encode($validated['categories']),
            'images' => json_encode($imagePaths),
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


    public function update(Request $request, $id)
    {

        $blog = Blog::findOrFail($id);
        // Gate::authorize('update-blog', $id);

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
            'deleted_images' => 'nullable|string', // Comma-separated string of deleted images
        ]);

        // convert meta_keywords, tags, and categories into JSON
        $validated['meta_keywords'] = $validated['meta_keywords'] ? explode(',', $validated['meta_keywords']) : [];
        $validated['tags'] = $validated['tags'] ? explode(',', $validated['tags']) : [];
        $validated['categories'] = $validated['categories'] ? explode(',', $validated['categories']) : [];

        // decode existing images
        $existingImages = json_decode($blog->images, true) ?? [];

        // delete the image file from storage if the user has deleted it
        $deletedImages = $validated['deleted_images'] ? explode(',', $validated['deleted_images']) : [];
        foreach ($deletedImages as $image) {
            if (in_array($image, $existingImages)) {
                // Delete the image file from storage
                Storage::disk('public')->delete($image);
            }
        }

        // filter out the deleted images from the existing images array
        $existingImages = array_filter($existingImages, fn($image) => !in_array($image, $deletedImages));

        // handle new image uploads
        $uploadedImages = [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('blogs/images', 'public');
                $uploadedImages[] = $path;
            }
        }

        // Merge remaining existing images with newly uploaded images
        $finalImages = array_merge($existingImages, $uploadedImages);

        $blog->update([
            'title' => $validated['title'],
            'content' => $validated['content'],
            'status' => $validated['status'],
            'meta_title' => $validated['meta_title'],
            'meta_description' => $validated['meta_description'],
            'meta_keywords' => json_encode($validated['meta_keywords']),
            'tags' => json_encode($validated['tags']),
            'categories' => json_encode($validated['categories']),
            'images' => json_encode($finalImages),
        ]);


        return redirect()->route('blogs.index')->with('success', 'Blog updated successfully!');
    }


    public function destroy(Blog $blog)
    {
        Gate::authorize('delete-blog', $blog);

        // decode images from the blog's images field
        $images = json_decode($blog->images, true);

        // check if images exist and are stored locally
        if ($images && is_array($images)) {
            foreach ($images as $image) {
                // delete only if the image path is within the 'public' directory
                if (Storage::disk('public')->exists($image)) {
                    Storage::disk('public')->delete($image);
                }
            }
        }

        // delete the blog record
        $blog->delete();
        return redirect()->route('blogs.index')->with('success', 'Blog deleted successfully!');
    }
}
