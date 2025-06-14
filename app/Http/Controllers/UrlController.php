<?php

namespace App\Http\Controllers;

use App\Models\Url;
use Illuminate\Http\Request;

class UrlController extends Controller
{
    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $request->validate(
            [
                'url' => 'required|active_url|max:255',
                'slug' => 'nullable|unique:urls|max:16|regex:/^[a-zA-Z0-9-_]+$/'
            ],
            [
                'url.required' => 'Url is required.',
                'url.active_url' => 'Url is not valid.',
                'url.max' => 'Url is too long.',
                'slug.unique' => 'This slug already exists',
                'slug.max' => 'Slug can\'t be longer than 16 characters',
                'slug.regex' => 'Slug can only contain alphanumeric characters, - and _'
            ]
        );
        $existingUrl = Url::where('url', $request->url)->first();
        if ($existingUrl) {
            // send url already exists message to display before url
            return back()->with('success', url('/') . '/' . strtolower($existingUrl->slug));
        }

        $url = new Url();
        $url->url = $request->url;

        $slug = strtolower($request->slug) ?: $this->generateSlug();

        $url->slug = $slug;

        $url->save();

        return back()->with('success', url('/') . '/' . $slug);
    }

    function generateSlug() {
        $length = mt_rand(5, 10);
        $slug = strtolower(str()->random($length));

        while (Url::where('slug', $slug)->exists()) {
            $slug = str()->random($length);
        }

        return $slug;
    }

    public function goToRoute(string $slug)
    {
        $url = Url::where('slug', $slug)->first();

        return redirect($url->url);
    }
}
