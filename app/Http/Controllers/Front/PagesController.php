<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;

class PagesController extends Controller
{
    public function homePage()
    {
        $categories = Category::all()
            ->sortBy('title')
            ->sortBy('position')
            ->where('publish', 1);
        return view('front.home')->with('categories', $categories);
    }

    public function categoryPage(Category $category)
    {
        if ($category->publish == 1) {
            $category->views++;
            $category->save();
            return view('front.category')->with('category', $category);
        }
        return redirect(route('home'))->with('error', 'Pagina cautata nu exista');
    }
}
