<?php

namespace App\Http\Controllers;

use App\Models\Recipe;
use App\Models\Tag;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tags = Tag::get()->sortBy("name");
        return view("tags.index", ["tags" => $tags]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($tag1, $tag2, $tag3)
    {
        $tagsArray = [$tag1, $tag2, $tag3]; // Convertit la chaîne en tableau de tags

        // Crée et attache les tags
        $tagOK = [];
        foreach ($tagsArray as $tagName) {
            $tagOK[] = Tag::firstOrCreate(['name' => $tagName]);
        }

        return $tagOK;
    }

    /**
     * Display the specified resource.
     */
    public function show(Tag $tag)
    {
        return view('tags.show', ["tag" => $tag]);
    }

    public static function clean_tags(array $tags_ids)
    {
        foreach ($tags_ids as $tag_id) {
            $tag = Tag::find($tag_id);
            if ($tag->recipes() == null) {
                $tag->delete();
            }
        }
    }

}
