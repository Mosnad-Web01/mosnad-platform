<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    /**
     * Display a listing of the blogs.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        $perPage = 10; // Number of blogs per page
        $page = $request->query('page', 1); // Get the 'page' query parameter

        $blogs = Blog::latest()
            ->paginate($perPage, ['*'], 'page', $page);

        // Decode JSON fields and process images for each blog
        $blogs->getCollection()->transform(function ($blog) {
            $blog->meta_keywords = $this->decodeJsonField($blog->meta_keywords);
            $blog->tags = $this->decodeJsonField($blog->tags);
            $blog->categories = $this->decodeJsonField($blog->categories);
            $blog->images = $this->processImages($blog->images);
            return $blog;
        });

        return response()->json([
            'success' => true,
            'blogs' => $blogs->items(),
            'current_page' => $blogs->currentPage(),
            'last_page' => $blogs->lastPage(),
            'total' => $blogs->total(),
        ]);
    }


    /**
     * Display the specified blog.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $blog = Blog::find($id);

        if (!$blog) {
            return response()->json([
                'success' => false,
                'message' => 'Blog not found.',
            ], 404);
        }

        // Decode JSON fields
        $blog->meta_keywords = $this->decodeJsonField($blog->meta_keywords);
        $blog->tags = $this->decodeJsonField($blog->tags);
        $blog->categories = $this->decodeJsonField($blog->categories);

        // Process images
        $blog->images = $this->processImages($blog->images);

        return response()->json([
            'success' => true,
            'blog' => $blog,
        ], 200);
    }

    /**
     * Process image URLs for blogs.
     *
     * @param  string|null  $images
     * @return array
     */
    private function processImages($images)
    {
        $imageUrls = $images ? json_decode($images, true) : [];

        return array_map(function ($image) {
            if (filter_var($image, FILTER_VALIDATE_URL)) {
                // External URL
                return $image;
            } else {
                // Local storage with fixed IP address for Next.js
                return 'http://127.0.0.1:8000/storage/' . $image;
            }
        }, $imageUrls);
    }

    /**
     * Decode JSON fields.
     *
     * @param  string|null  $field
     * @return array
     */
    private function decodeJsonField($field)
    {
        return $field ? json_decode($field, true) : [];
    }
}
