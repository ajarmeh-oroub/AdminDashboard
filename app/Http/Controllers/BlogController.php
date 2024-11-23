<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $blogs = Blog::orderBy('created_at', 'desc')->with('user')->get();
        return view('blog.index', compact('blogs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('blog.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated=$request->validate([
            'title'=>'required',
            'content'=>'required',
            'image'=>'required|mimes:jpeg,jpg,png',
            'video'=>'nullable|url',

        ]);
        if ($request->hasFile('image')) {
            // Get the uploaded image file
            $image = $request->file('image');

            // Generate a unique filename for the image
            $fileName = time() . '_' . $image->getClientOriginalName();

            // Store the image in the 'uploads' folder within 'public' disk
            $filePath = $image->storeAs('uploads', $fileName, 'public');

            // Add the image path to the validated data
            $validated['image'] = $filePath;


        }

        if ($request->has('video')) {
            $validated['video'] = $request->input('video');
        }
        $validated['author_id'] = auth()->id();
       Blog::create($validated);
        return redirect()->route('blog.index');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $blog = Blog::with('user')->findOrFail($id);
            return view('blog.show', compact('blog'));
        } catch (ModelNotFoundException $e) {
            abort(404, 'Blog not found');
        }
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $blog = Blog::with('user')->findOrFail($id);
        return view('blog.edit', compact('blog'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validate the incoming request data
        $validated = $request->validate([
            'title' => 'required',
            'content' => 'required',
            'image' => 'mimes:jpeg,jpg,png|max:2048',
            'video' => 'url',
        ]);


        $blog = Blog::findOrFail($id);


        if ($request->hasFile('image')) {

            $image = $request->file('image');


            $fileName = time() . '_' . $image->getClientOriginalName();


            $filePath = $image->storeAs('uploads', $fileName, 'public');


            $validated['image'] = $filePath;


            if ($blog->image) {
                \Storage::disk('public')->delete($blog->image);
            }
        }

        if ($request->has('video')) {
            $validated['video'] = $request->input('video');
        }

        // Update the blog with the validated data
        $blog->update($validated);

        // Redirect back to the blog details page
        return redirect()->route('blog.show', $blog->id);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $blog= Blog::findorfail($id);
        $blog->delete();
        return redirect()->route('blog.index');
    }
}
