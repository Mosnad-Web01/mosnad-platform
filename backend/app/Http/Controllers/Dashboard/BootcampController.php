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
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'features' => 'required|string',
            'fees' => 'required|numeric',
            'instructor' => 'required|string',
            'training_duration' => 'required|integer',
            'main_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'additional_images' => 'nullable|array',
            'additional_images.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $data = $request->all();
        
        if ($request->hasFile('main_image')) {
            $data['main_image'] = $request->file('main_image')->store('public/bootcamp_images');
        }

        if ($request->hasFile('additional_images')) {
            $data['additional_images'] = array_map(function ($image) {
                return $image->store('public/bootcamp_images');
            }, $request->file('additional_images'));
        }

        Bootcamp::create($data);

        return redirect()->route('bootcamps.index')->with('success', 'Bootcamp created successfully!');
    }

    public function edit($id)
    {
        $bootcamp = Bootcamp::findOrFail($id);
        return view('dashboard.bootcamps.edit', compact('bootcamp'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'features' => 'required|string',
            'fees' => 'required|numeric',
            'instructor' => 'required|string',
            'training_duration' => 'required|integer',
            'main_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'additional_images' => 'nullable|array',
            'additional_images.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $bootcamp = Bootcamp::findOrFail($id);
        $data = $request->all();
        
        if ($request->hasFile('main_image')) {
            // Delete the old image if it exists
            if ($bootcamp->main_image && Storage::exists($bootcamp->main_image)) {
                Storage::delete($bootcamp->main_image);
            }
            $data['main_image'] = $request->file('main_image')->store('public/bootcamp_images');
        }

        if ($request->hasFile('additional_images')) {
            // Delete old additional images if they exist
            if ($bootcamp->additional_images) {
                foreach ($bootcamp->additional_images as $imagePath) {
                    if (Storage::exists($imagePath)) {
                        Storage::delete($imagePath);
                    }
                }
            }

            $data['additional_images'] = array_map(function ($image) {
                return $image->store('public/bootcamp_images');
            }, $request->file('additional_images'));
        }

        $bootcamp->update($data);

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
