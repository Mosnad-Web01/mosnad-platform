<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Bootcamp;
use Illuminate\Support\Facades\Storage;

class BootcampController extends Controller
{
    public function index()
    {
        $bootcamps = Bootcamp::paginate(10);
        return view('dashboard.bootcamps.index', compact('bootcamps'));
    }

    public function show($id)
    {
        $bootcamp = Bootcamp::findOrFail($id);
        return view('dashboard.bootcamps.show', compact('bootcamp'));
    }

    public function create()
    {
        return view('dashboard.bootcamps.create');
    }

    public function store(Request $request)
    {
        // Validation Rules
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'description' => 'required|string',
            'features' => 'required|string',
            'fees' => [
                'required',
                'numeric',
                'regex:/^\d{1,8}(\.\d{1,2})?$/', // Up to 8 digits, optional 2 decimals
            ],
            'instructor' => 'required|string|max:255',
            'training_duration' => 'required|integer|min:1',
            'main_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'additional_images' => 'nullable|array',
            'additional_images.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ], [
            // Custom error messages
            'name.required' => 'The bootcamp name is required.',
            'description.required' => 'The description is required.',
            'features.required' => 'The features are required.',
            'fees.required' => 'The fees are required.',
            'fees.regex' => 'Fees must be a numeric value with a maximum of 8 digits and optional 2 decimal places.',
            'instructor.required' => 'The instructor name is required.',
            'training_duration.required' => 'The training duration is required.',
            'main_image.required' => 'The main image is required.',
            'main_image.image' => 'The main image must be a valid image file.',
            'main_image.mimes' => 'Allowed formats for the main image are jpeg, png, jpg, gif, svg.',
            'main_image.max' => 'The main image size cannot exceed 2MB.',
            'additional_images.*.image' => 'Each additional image must be a valid image file.',
            'additional_images.*.mimes' => 'Allowed formats for additional images are jpeg, png, jpg, gif, svg.',
            'additional_images.*.max' => 'Each additional image size cannot exceed 2MB.',
        ]);

        // Prepare data for storing
        $data = $validatedData;

        // Handle main image
        if ($request->hasFile('main_image')) {
            $data['main_image'] = $request->file('main_image')->store('public/bootcamp_images');
        }

        // Handle additional images
        if ($request->hasFile('additional_images')) {
            $data['additional_images'] = array_map(function ($image) {
                return $image->store('public/bootcamp_images');
            }, $request->file('additional_images'));
        }

        // Create the bootcamp
        Bootcamp::create($data);

        // Redirect with success message
        return redirect()->route('bootcamps.index')->with('success', 'Bootcamp created successfully!');
    }

    public function edit($id)
    {
        $bootcamp = Bootcamp::findOrFail($id);
        return view('dashboard.bootcamps.edit', compact('bootcamp'));
    }

    public function update(Request $request, $id)
{
    // Validation Rules
    $validatedData = $request->validate([
        'name' => 'required|string|max:255',
        'city' => 'required|string|max:255',
        'description' => 'required|string',
        'features' => 'required|string',
        'fees' => [
            'required',
            'numeric',
            'regex:/^\d{1,8}(\.\d{1,2})?$/', // Up to 8 digits, optional 2 decimals
        ],
        'instructor' => 'required|string|max:255',
        'training_duration' => 'required|integer|min:1',
        'main_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        'additional_images' => 'nullable|array',
        'additional_images.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    ], [
        // Custom error messages
        'name.required' => 'The bootcamp name is required.',
        'description.required' => 'The description is required.',
        'features.required' => 'The features are required.',
        'fees.required' => 'The fees are required.',
        'fees.regex' => 'Fees must be a numeric value with a maximum of 8 digits and optional 2 decimal places.',
        'instructor.required' => 'The instructor name is required.',
        'training_duration.required' => 'The training duration is required.',
        'main_image.image' => 'The main image must be a valid image file.',
        'main_image.mimes' => 'Allowed formats for the main image are jpeg, png, jpg, gif, svg.',
        'main_image.max' => 'The main image size cannot exceed 2MB.',
        'additional_images.*.image' => 'Each additional image must be a valid image file.',
        'additional_images.*.mimes' => 'Allowed formats for additional images are jpeg, png, jpg, gif, svg.',
        'additional_images.*.max' => 'Each additional image size cannot exceed 2MB.',
    ]);

    // Find the bootcamp or fail
    $bootcamp = Bootcamp::findOrFail($id);

    // Prepare data for update
    $data = $validatedData;

    // Handle main image
    if ($request->hasFile('main_image')) {
        // Delete the old main image if it exists
        if ($bootcamp->main_image && Storage::exists($bootcamp->main_image)) {
            Storage::delete($bootcamp->main_image);
        }
        // Store the new main image
        $data['main_image'] = $request->file('main_image')->store('public/bootcamp_images');
    }

    // Handle additional images
    if ($request->hasFile('additional_images')) {
        // Delete the old additional images if they exist
        if (!empty($bootcamp->additional_images)) {
            foreach ($bootcamp->additional_images as $imagePath) {
                if (Storage::exists($imagePath)) {
                    Storage::delete($imagePath);
                }
            }
        }

        // Store new additional images
        $data['additional_images'] = array_map(function ($image) {
            return $image->store('public/bootcamp_images');
        }, $request->file('additional_images'));
    }

    // Update the bootcamp
    $bootcamp->update($data);

    // Redirect with success message
    return redirect()->route('bootcamps.show', $bootcamp->id)
        ->with('success', 'Bootcamp updated successfully!');
}

    public function destroy($id)
    {
        $bootcamp = Bootcamp::findOrFail($id);

        // Delete associated images
        if ($bootcamp->main_image && Storage::exists($bootcamp->main_image)) {
            Storage::delete($bootcamp->main_image);
        }

        if ($bootcamp->additional_images) {
            foreach ($bootcamp->additional_images as $imagePath) {
                if (Storage::exists($imagePath)) {
                    Storage::delete($imagePath);
                }
            }
        }

        $bootcamp->delete();
        return redirect()->route('bootcamps.index')->with('success', 'Bootcamp deleted successfully!');
    }
}
