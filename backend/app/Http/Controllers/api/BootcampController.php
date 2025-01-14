<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Bootcamp;
use Illuminate\Http\Request;

class BootcampController extends Controller
{
    // Fetch all bootcamps with pagination (10 per page)
    public function index()
    {
        $bootcamps = Bootcamp::latest()->paginate(10)->map(function ($bootcamp) {
            // Handle the main image
            if ($bootcamp->main_image) {
                if (filter_var($bootcamp->main_image, FILTER_VALIDATE_URL)) {
                    $bootcamp->main_image = $bootcamp->main_image; // External URL
                } else {
                    $bootcamp->main_image = "http://127.0.0.1:8000/storage/" . $bootcamp->main_image; // Local storage URL
                }
            } else {
                $bootcamp->main_image = null;
            }

            // Handle additional images
            if ($bootcamp->additional_images) {
                $bootcamp->additional_images = array_map(function ($image) {
                    if (filter_var($image, FILTER_VALIDATE_URL)) {
                        return $image; // External URL
                    } else {
                        return "http://127.0.0.1:8000/storage/" . $image; // Local storage URL
                    }
                }, $bootcamp->additional_images);
            } else {
                $bootcamp->additional_images = null;
            }

            return $bootcamp;
        });

        return response()->json([
            'bootcamps' => $bootcamps,
        ], 200);
    }

    // Fetch a single bootcamp by its ID
    public function show($id)
    {
        $bootcamp = Bootcamp::find($id);

        if (!$bootcamp) {
            return response()->json(['message' => 'Bootcamp not found'], 404);
        }

        // Handle the main image
        if ($bootcamp->main_image) {
            if (filter_var($bootcamp->main_image, FILTER_VALIDATE_URL)) {
                $bootcamp->main_image = $bootcamp->main_image; // External URL
            } else {
                $bootcamp->main_image = "http://127.0.0.1:8000/storage/" . $bootcamp->main_image; // Local storage URL
            }
        } else {
            $bootcamp->main_image = null;
        }

        // Handle additional images
        if ($bootcamp->additional_images) {
            $bootcamp->additional_images = array_map(function ($image) {
                if (filter_var($image, FILTER_VALIDATE_URL)) {
                    return $image; // External URL
                } else {
                    return "http://127.0.0.1:8000/storage/" . $image; // Local storage URL
                }
            }, $bootcamp->additional_images);
        } else {
            $bootcamp->additional_images = null;
        }

        return response()->json($bootcamp);
    }
}
