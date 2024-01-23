<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\File;
use App\Models\Post;
use App\Models\PostCategory;
use App\Models\SeoMetaTag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PostController extends BackendController
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Items per page
        $perPage = getOption('post_per_page_opt', 8);
        $search = '';
        if ($request->search && $request->search !== '') {
            $search = $request->search;
        }
        if ($search !== '') {
            $posts = Post::where('title', 'LIKE', '%' . $search . '%')
                ->orWhere('status', 'LIKE', '%' . $search . '%')
                ->paginate($perPage);
        } else {
            $posts = Post::paginate($perPage);
        }
        return view('backend.posts.index', compact(['posts', 'search']));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $postCategories = PostCategory::all();
        return view('backend.posts.create', compact('postCategories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $post = new Post($request->all());
        $post->created_by = Auth::user()->id;
        $post->slug = Str::slug($post->title, '-');

        if ($request->post_image) {
            $imageFile = $request->file('post_image');
            $extension  = $imageFile->getClientOriginalExtension();
            $originalName = $imageFile->getClientOriginalName();
            $mimeType = $imageFile->getMimeType();
            $imagePath = date('Y') . "/" . date('m');
            $size = $imageFile->getSize();
            // Check is image already exists
            if (File::where('path', $imagePath . "/" . $originalName)->exists()) {
                $originalName = $this->regenerateOriginalName($imagePath, $originalName, $extension);
            }
            $path = Storage::disk('public')->putFileAs($imagePath, $imageFile, $originalName);
            $imageData = [
                "name" => str_replace("." . $extension, "", $originalName),
                "path" => $path,
                "size" => $size,
                "mime_type" => $mimeType,
                "extension" => $extension,
                "media_type" => "image",
                "created_by" => Auth::id()
            ];
            $uploadedImage = File::create($imageData)->id;
            $post->image_id = $uploadedImage;
        }


        $post->save();
        $id = $post->id;
        return response()->json(['success' => true, 'error' => null, 'id' => $id, 'url' => route('backend.posts.edit', $id)]);
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

        $post = Post::with('categories')->findOrFail($id);
        $postCategories = PostCategory::all();
        $postCategoriesIds = $post->categories->pluck('id')->toArray();
        return view('backend.posts.edit', compact(['post', 'postCategories', 'postCategoriesIds']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'title' => 'required',
            'slug' => 'required'
        ]);

        $keywords = $this->generateSeoKeywords(strip_tags($request->content));

        $seo = SeoMetaTag::where('Model', 'Post')->where('model_id', $id)->first();
        if ($seo) {
            if ($seo->keywords == '') {
                $seo->keywords = $keywords;
                $seo->save();
            }
        } else {
            $seo = new SeoMetaTag();
            $seo->model = 'Post';
            $seo->model_id = $id;
            $seo->title = $request->title;
            $seo->keywords = $keywords;
            $seo->save();
        }


        $post = Post::find($id);
        $post->update($request->except('post_image'));
        $post->categories()->sync($request->categories);

        if ($request->post_image) {
            $imageFile = $request->file('post_image');
            $extension  = $imageFile->getClientOriginalExtension();
            $originalName = $imageFile->getClientOriginalName();
            $mimeType = $imageFile->getMimeType();
            $imagePath = date('Y') . "/" . date('m');
            $size = $imageFile->getSize();
            // Check is image already exists
            if (File::where('path', $imagePath . "/" . $originalName)->exists()) {
                $originalName = $this->regenerateOriginalName($imagePath, $originalName, $extension);
            }
            $path = Storage::disk('public')->putFileAs($imagePath, $imageFile, $originalName);
            $imageData = [
                "name" => str_replace("." . $extension, "", $originalName),
                "path" => $path,
                "size" => $size,
                "mime_type" => $mimeType,
                "extension" => $extension,
                "media_type" => "image",
                "created_by" => Auth::id()
            ];
            $uploadedImage = File::create($imageData)->id;
            $post->image_id = $uploadedImage;
        }

        $post->save();

        return redirect()->route('backend.posts.edit', [$id])
            ->with('success', 'Updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $post = Post::find($id);
        $post->delete();
        return response()->json(['type' => 'success', 'message' => 'Deleted!'], 200);
    }

    /**
     * Settings for Posts
     */
    public function settings()
    {
        $posts = Post::all();
        $postCategories = PostCategory::all();
        $options = getOptions('post_');
        return view('backend.posts.settings', compact(['posts', 'postCategories', 'options']));
    }

    public function regenerateOriginalName($imagePath, $originalName, $extension)
    {
        $newOriginalName = '';
        $totalFilesSameName = File::where('path', $imagePath . "/" . $originalName)->count();
        $newOriginalName = str_replace("." . $extension, "-" . $totalFilesSameName . "." . $extension, $originalName);
        return $newOriginalName;
    }

    public function generateSeoKeywords($text)
    {
        // Clean the text by removing special characters and converting to lowercase
        $cleanedText = Str::lower(preg_replace('/[^a-zA-Z0-9\s]/', '', $text));

        // Tokenize the text into words
        $words = str_word_count($cleanedText, 1);

        // Create an array to store bigrams
        $bigrams = [];

        // Generate bigrams
        for ($i = 0; $i < count($words) - 1; $i++) {
            $bigram = $words[$i] . ' ' . $words[$i + 1];
            $bigrams[] = $bigram;
        }

        // Count the occurrences of each bigram
        $bigramCounts = array_count_values($bigrams);

        // Sort the bigrams by occurrence in descending order
        arsort($bigramCounts);

        // Extract the most common double words (bigrams)
        $mostCommonBigrams = array_slice($bigramCounts, 0, 5); // Change 5 to the desired number of results

        $words = '';
        // Output the results
        foreach ($mostCommonBigrams as $bigram => $count) {
            Log::info("$bigram: $count occurrences");
            $words .= $bigram . ',';
        }

        return $words;
    }
}
