<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Page;
use App\Models\User;

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

    public function showArticles()
    {
        if (request('all_articles')) {
            $pages = Page::where('published_at', '<>', null)
                ->orderByDesc('published_at')
                ->paginate(10)
                ->withQueryString();

            return view('front.articles')
                ->with('pages', $pages)
                ->with('all_articles', 'Lista cu toate articolele ');
        }

        if (request('author')) {
            $author = User::findOrFail(request('author'));

            $pages = $author->public_pages();

            return view('front.articles')
                ->with('pages', $pages)
                ->with('author', 'Lista cu articolele autorului ' . $author->name . ' ');
        }

        if (request('search')) {
            $search = request('search');
            $pages = Page::whereNotNull('published_at')
                ->where(function ($query) use ($search) {
                    return $query
                        ->where('title', 'LIKE', "%{$search}%")
                        ->orWhere('subtitle', 'LIKE', "%{$search}%")
                        ->orWhere('meta_description', 'LIKE', "%{$search}%");
                })


                ->orderByDesc('published_at')
                ->paginate(10)
                ->withQueryString();

            return view('front.articles')
                ->with('pages', $pages)
                ->with('search', 'Lista cu articolele gasite pentru: ' . $search);
        }
    }

    public function showSingleArticle(Page $page)
    {
        // $page = Page::where('slug', $slug)->first();
        if (isset($page)) {
            $page->views++;
            $page->save();
            return view("front.article-single")->with('page', $page);
        } else {
            return view("front.home")->with('error', 'Pagina cautata nu exista!');
        }
    }
}
