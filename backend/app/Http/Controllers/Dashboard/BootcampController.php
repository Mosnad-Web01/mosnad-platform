<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Bootcamp;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Session;

class BootcampController extends Controller
{
    /**
     * Display a listing of the bootcamps.
     */
    public function index()
    {
        $bootcamps = Bootcamp::paginate(10);
        return view('dashboard.bootcamps.index', compact('bootcamps'));
    }

    /**
     * Show the form for creating a new bootcamp.
     */
    public function create()
    {
        return view('dashboard.bootcamps.create');
    }

    /**
     * Store a newly created bootcamp in storage.
     */
    public function store(Request $request)
    {
        // Validate the input
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'description' => 'required|string',
            'features' => 'required|string',
            'fees' => 'required|numeric',
            'instructor' => 'required|string|max:255',
            'training_duration' => 'required|integer|min:1',
            'main_image' => 'required|image|mimes:jpeg,png,jpg,webp,svg|max:5048',
            'additional_images' => 'nullable|array',
            'additional_images.*' => 'image|mimes:jpeg,png,jpg,webp,svg|max:5048',
        ]);
    
        try {
            // Handle the main image upload
            if ($request->hasFile('main_image')) {
                $mainImagePath = $request->file('main_image')->store('bootcamp_images', 'public');
                $validatedData['main_image'] = $mainImagePath;
            }
    
            // Handle additional images if provided
            if ($request->hasFile('additional_images')) {
                $validatedData['additional_images'] = array_map(function ($image) {
                    return $image->store('bootcamp_images', 'public');
                }, $request->file('additional_images'));
            }
    
            // Save the bootcamp
            $bootcamp = Bootcamp::create($validatedData);
    
            // Flash success message
            if ($bootcamp) {
                Session::flash('success', 'Bootcamp created successfully!');
                return redirect()->route('bootcamps.index');
            } else {
                Session::flash('error', 'An error occurred while creating the bootcamp.');
                return back()->withInput();
            }
        } catch (\Exception $e) {
            // Log the exception or handle errors if needed
            Session::flash('error', 'An unexpected error occurred: ' . $e->getMessage());
            return back()->withInput();
        }
    }

    /**
     * Display the specified bootcamp.
     */
    public function show($id)
    {
        $bootcamp = Bootcamp::findOrFail($id);

        // Append the public URL to the image paths to ensure the image can be accessed publicly
        $bootcamp->main_image = Storage::url($bootcamp->main_image);
        if (!empty($bootcamp->additional_images)) {
            $bootcamp->additional_images = array_map(function ($image) {
                return Storage::url($image);
            }, $bootcamp->additional_images);
        }

        return view('dashboard.bootcamps.show', compact('bootcamp'));
    }

    /**
     * Show the form for editing the specified bootcamp.
     */
    public function edit($id)
    {
        $bootcamp = Bootcamp::findOrFail($id);
        return view('dashboard.bootcamps.edit', compact('bootcamp'));
    }

    /**
     * Update the specified bootcamp in storage.
     */
    public function update(Request $request, Bootcamp $bootcamp)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'description' => 'required|string',
            'features' => 'required|string',
            'fees' => 'required|numeric',
            'instructor' => 'required|string|max:255',
            'training_duration' => 'required|integer|min:1',
            'main_image' => 'nullable|image|mimes:jpeg,png,jpg,webp,svg|max:5048',
            'additional_images' => 'nullable|array',
            'additional_images.*' => 'image|mimes:jpeg,png,jpg,webp,svg|max:5048',
        ]);
    
        // Handle the main image upload if a new image is provided
        if ($request->hasFile('main_image')) {
            $mainImagePath = $request->file('main_image')->store('bootcamp_images', 'public');
            $validatedData['main_image'] = $mainImagePath;
    
            // Delete the old main image if it exists
            if ($bootcamp->main_image) {
                \Storage::disk('public')->delete($bootcamp->main_image);
            }
        }
    
        // Handle additional images if provided
        if ($request->hasFile('additional_images')) {
            // Delete old additional images if they exist
            if (!empty($bootcamp->additional_images)) {
                foreach ($bootcamp->additional_images as $imagePath) {
                    \Storage::disk('public')->delete($imagePath);
                }
            }
    
            // Store the new additional images
            $validatedData['additional_images'] = array_map(function ($image) {
                return $image->store('bootcamp_images', 'public');
            }, $request->file('additional_images'));
        }
    
        // Update the bootcamp
        $bootcamp->update($validatedData);
    
        // Flash a success message
        Session::flash('success', 'Bootcamp updated successfully!');
        return redirect()->route('bootcamps.index');
        
    }

    /**
     * Remove the specified bootcamp from storage.
     */
    public function destroy($id)
    {
        $bootcamp = Bootcamp::findOrFail($id);

        // Delete the main image
        if ($bootcamp->main_image) {
            Storage::disk('public')->delete($bootcamp->main_image);
        }

        // Delete additional images
        if (!empty($bootcamp->additional_images)) {
            foreach ($bootcamp->additional_images as $imagePath) {
                Storage::disk('public')->delete($imagePath);
            }
        }

        // Delete the bootcamp
        $bootcamp->delete();

        // Flash success message
        Session::flash('success', 'Bootcamp deleted successfully!');

        return redirect()->route('bootcamps.index');
    }
}
