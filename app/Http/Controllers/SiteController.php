<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;
use Illuminate\View\View;

class SiteController extends Controller
{
    public function home(): View
    {
        return view('pages.home');
    }

    public function services(): View
    {
        return view('pages.services');
    }

    public function service(string $slug): View
    {
        $service = config("site.services.$slug") ?? abort(404);

        return view('pages.service', compact('slug', 'service'));
    }

    public function area(string $slug): View
    {
        $city = config("site.cities.$slug") ?? abort(404);

        return view('pages.area', compact('slug', 'city'));
    }

    public function about(): View
    {
        return view('pages.about');
    }

    public function blog(): View
    {
        return view('pages.blog');
    }

    public function post(string $slug): View
    {
        $post = config("site.posts.$slug") ?? abort(404);

        return view('pages.post', compact('slug', 'post'));
    }

    public function contact(): View
    {
        return view('pages.contact');
    }

    public function sitemap(): Response
    {
        $urls = [route('home'), route('services'), route('about'), route('blog'), route('contact')];
        foreach (array_keys(config('site.services')) as $slug) {
            $urls[] = route('service', $slug);
        }
        foreach (array_keys(config('site.cities')) as $slug) {
            $urls[] = route('area', $slug);
        }
        foreach (array_keys(config('site.posts')) as $slug) {
            $urls[] = route('post', $slug);
        }

        return response()
            ->view('sitemap', compact('urls'))
            ->header('Content-Type', 'application/xml');
    }
}
