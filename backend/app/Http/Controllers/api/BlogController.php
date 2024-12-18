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
        $perPage = 6; // Number of blogs per page
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
/**
 * Search blogs by various criteria.
 *
 * @param  \Illuminate\Http\Request  $request
 * @return \Illuminate\Http\JsonResponse
 */
public function search(Request $request)
{
    $query = $request->get('query');

    if (empty($query)) {
        return response()->json([
            'success' => true,
            'blogs' => [],
            'message' => 'No search query provided'
        ]);
    }

    try {
        $blogs = Blog::where(function($q) use ($query) {
            // Basic text search for title and content
            $q->where('title', 'LIKE', "%{$query}%")
              ->orWhere('content', 'LIKE', "%{$query}%")
              // JSON search for tags
              ->orWhereRaw("JSON_SEARCH(LOWER(tags), 'one', ?)", ["%{$query}%"])
              // JSON search for categories
              ->orWhereRaw("JSON_SEARCH(LOWER(categories), 'one', ?)", ["%{$query}%"])
              // JSON search for meta_keywords
              ->orWhereRaw("JSON_SEARCH(LOWER(meta_keywords), 'one', ?)", ["%{$query}%"]);
        })
        ->where('status', 'published')
        ->latest()
        ->get();

        // Process the JSON fields
        $blogs->transform(function ($blog) {
            return [
                'id' => $blog->id,
                'title' => $blog->title,
                'content' => $blog->content,
                'meta_title' => $blog->meta_title,
                'meta_description' => $blog->meta_description,
                'meta_keywords' => json_decode($blog->meta_keywords, true) ?? [],
                'tags' => json_decode($blog->tags, true) ?? [],
                'categories' => json_decode($blog->categories, true) ?? [],
                'images' => json_decode($blog->images, true) ?? [],
                'created_at' => $blog->created_at,
                'updated_at' => $blog->updated_at,
            ];
        });

        return response()->json([
            'success' => true,
            'blogs' => $blogs,
            'message' => $blogs->count() > 0 ? 'Blogs found' : 'No blogs found'
        ]);

    } catch (\Exception $e) {
        return response()->json([
            'success' => false,
            'message' => 'Error performing search',
            'error' => $e->getMessage()
        ], 500);
    }
}

}
