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
                'slug' => 'unique:urls'
            ],
            [
                'url.required' => 'Url is required.',
                'url.active_url' => 'Url is not valid.',
                'url.max' => 'Url is too long.',
                'slug.unique' => 'This slug already exists'
            ]
        );
        $existingUrl = Url::where('url', $request->url)->first();
        if ($existingUrl) {
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
