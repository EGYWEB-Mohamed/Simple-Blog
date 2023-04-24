<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Artesaos\SEOTools\Facades\SEOTools;

class HomeController extends Controller
{
    public function home()
    {
        SEOTools::setTitle('Home');
        return view('front.home');
    }
}
