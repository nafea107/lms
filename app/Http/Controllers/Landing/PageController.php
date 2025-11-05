<?php

namespace App\Http\Controllers\Landing;

use App\Http\Controllers\Controller;
use App\Mail\ContactMail;
use App\Models\Category;
use App\Models\Page;
use App\Models\Setting;
use Illuminate\Http\Request;
use Inertia\Inertia;

class PageController extends Controller
{
    public function show($locale, $slug)
    {
        switch ($slug) {
            case 'instructor':
                return $this->instructor();
            case 'categories':
                return $this->categories();
            case 'courses':
                return $this->courses();
            case 'contact':
                return $this->contact();
            case 'about':
                return $this->about();
            default:
                abort(404);
        }
    }

    private function instructor()
    {
        $page = Page::where('slug', 'instructor')->first();
        return Inertia::render('Landing/Pages/Instructor', [
            'page' => $page,
        ]);
    }

    private function categories()
    {
        // $page = Page::where('slug', 'categories')->first();
        return Inertia::render('Landing/Pages/Categories', [
            //   'page' => $page,
        ]);
    }
    private function courses()
    {
        $page = Page::where('slug', 'courses')->first();
        $footerPage = Page::where('slug', 'footer')->first();
        return Inertia::render('Landing/Pages/Courses', [
            'page' => $page,
            'footerPage' => $footerPage,
            'categories' => Category::get(),
        ]);
    }

    private function contact()
    {
        $page = Page::where('slug', 'home')->first()->toArray();
        $app_name = Setting::where('key', 'app_name')->first()?->value;
        $whatsapp = Setting::where('key', 'whatsapp')->first()?->value;
        $facebook = Setting::where('key', 'facebook')->first()?->value;
        return Inertia::render('Landing/Pages/Contact', [
            'image' => $page['data']['image_2']['value'],
            'app_name' => $app_name,
            'whatsapp' => $whatsapp,
            'facebook' => $facebook,
        ]);
    }

    private function about()
    {
        $page = Page::where('slug', 'about')->first();
        $whatsapp = Setting::where('key', 'whatsapp')->first()?->value;

        return Inertia::render('Landing/Pages/About', [
            'page' => $page,
            'whatsapp' => $whatsapp
        ]);
    }

    public function sendEmail(Request $request)
    {
        $data = $request->validate([
            'message' => 'required|string',
        ]);

        \Mail::to(getenv('ADMIN_EMAIL'))->send(new ContactMail(message: $data['message']));
    }
}
