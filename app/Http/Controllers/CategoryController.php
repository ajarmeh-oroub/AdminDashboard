<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::orderBy('id', 'desc')->get();
        return view('category.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        return view('category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate incoming request
        $validated = $request->validate([
            'name' => 'required|string|max:255', // Ensure name is a required string
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Ensure image is uploaded and valid
        ]);

        // Check if image is uploaded and handle file storage
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $fileName = time() . '_' . $image->getClientOriginalName();
            $filePath = $image->storeAs('uploads', $fileName, 'public');
            $validated['image'] = $filePath; // Add file path to the validated array
        }

        // Create a new category
        $category = new Category();
        $category->name = $validated['name']; // Assign the validated name
        $category->image = $validated['image']; // Assign the validated image file path

        // Save the category
        $category->save();

        return redirect()->route('category.index')->with('success', 'Category created successfully.');
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $category= Category::findorfail($id);
        return view('category.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validate the request data
        $validated = $request->validate([
            'name' => 'required|string|max:255', // Name is required and must be a string
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Image validation rules
        ]);

        // Find the existing category by ID
        $category = Category::findOrFail($id);

        // Check if a new image is uploaded
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $fileName = time() . '_' . $image->getClientOriginalName();
            $filePath = $image->storeAs('uploads', $fileName, 'public');
            $validated['image'] = $filePath;

            // Optionally delete the old image from storage if needed
            if ($category->image) {
                \Storage::disk('public')->delete($category->image);
            }
        }

        // Update the category with validated data
        $category->update($validated);

        // Redirect back with success message
        return redirect()->route('category.index')->with('success', 'Category updated successfully.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category=Category::find($id);
        $category->delete();
        return redirect()->route('category.index')->with('success', 'Category deleted successfully.');
    }
}
