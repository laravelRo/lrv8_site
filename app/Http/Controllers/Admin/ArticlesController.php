<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Page;
use App\Models\User;
use App\Models\Category;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Str;
use App\Http\Requests\PageAddRequest;
use Illuminate\Support\Facades\File;

class ArticlesController extends Controller
{
    public function showPages()
    {
        $categs = Category::select('id', 'title')->orderBy('title')->get();

        // === paginile intoarse dupa SEARCH
        if (request('search')) {
            $search = request('search');
            $pages = Page::sortable(['created_at' => 'desc'])
                ->where('title', 'LIKE', "%{$search}%")
                ->orWhere('meta_description', 'LIKE', "%{$search}%")
                ->paginate()
                ->withQueryString();

            return view('admin.pages.pages')
                ->with('pages', $pages)
                ->with('categs', $categs)
                ->with('search', $search);
        }

        // === paginiline pe categorii
        if (request('categs')) {
            $category = Category::findOrFail(request('categs'));

            $pages = $category->pages()
                ->sortable(['created_at' => 'desc'])
                ->paginate()
                ->withQueryString();


            $categs_title = $category->title;

            return view('admin.pages.pages')
                ->with('pages', $pages)
                ->with('categs', $categs)
                ->with('categs_title', $categs_title);
        }

        // === paginile intoarse dupa AUTHOR
        if (request('author')) {
            $pages = Page::sortable(['created_at' => 'desc'])
                ->where('user_id', request('author'))
                ->paginate()
                ->withQueryString();

            $author_name = User::findOrFail(request('author'))->name;
            return view('admin.pages.pages')
                ->with('pages', $pages)
                ->with('categs', $categs)
                ->with('author_name', $author_name);
        }

        // === paginile PUBLICE
        if (request('published') == 1) {
            $pages = Page::sortable(['created_at' => 'desc'])->where('published_at', '<>', null)->paginate()->withQueryString();
            $published = " - only published pages ";
            return view('admin.pages.pages')
                ->with('pages', $pages)
                ->with('categs', $categs)
                ->with('published', $published);
        }

        // -- paginile NE-PUBLICE
        if (request('published') == 2) {
            $pages = Page::sortable(['created_at' => 'desc'])->where('published_at', null)->paginate()->withQueryString();
            $published = " - only draft pages ";
            return view('admin.pages.pages')
                ->with('published', $published)
                ->with('categs', $categs)
                ->with('pages', $pages);
        }

        $pages = Page::sortable(['created_at' => 'desc'])->paginate()->withQueryString();
        return view('admin.pages.pages')
            ->with('categs', $categs)
            ->with('pages', $pages);
    }

    public function newPage()
    {
        if (auth()->user()->role == 'admin') {
            $authors = User::select('id', 'name')
                ->where('role', 'author')
                ->orderBy('name')
                ->get();
            return view('admin.pages.page-new')->with('authors', $authors);
        }
        return view('admin.pages.page-new');
    }

    public function addPage(PageAddRequest $request)
    {
        if (!Gate::allows('author-rights')) {
            return redirect(route('admin.categories'))->with('error', 'Nu aveti dreptul sa executati aceasta actiune');
        }
        $this->validate(
            $request,
            [
                'slug' => 'unique:pages,slug'
            ],
            [
                'slug.unique' => 'Acest slug este deja utilizat in baza de date'
            ]
        );

        $page = new Page;

        $page->title = $request->title;
        $page->slug = Str::slug($request->slug);
        $page->subtitle = $request->subtitle;

        $page->excerpt = $request->excerpt;
        $page->presentation = $request->presentation;
        $page->content = $request->content;

        $page->views = $request->views;

        if ($request->publish == 1) {
            $page->published_at = $request->published_at;
        }

        // ==== setarea autorului articolului
        if (auth()->user()->role == 'author') {
            $page->user_id = auth()->id();
        }
        if (auth()->user()->role == 'admin') {
            $page->user_id = $request->user_id;
        }


        $page->meta_title = $request->meta_title;
        $page->meta_description = $request->meta_description;
        $page->meta_keywords = $request->meta_keywords;


        if ($request->hasFile('photo')) {
            $extension = $request->file('photo')->getClientOriginalExtension();
            $photoName = str_replace(' ', '', $request->title) . '_' . time() . '.' . $extension;

            $request->file('photo')->move('images/pages', $photoName);

            $page->photo = $photoName;
        }
        $mess = 'Articolul ' . $request->title . ' a fost adaugat in baza de date. ';

        $page->save();

        return redirect(route('admin.pages'))->with('success', $mess);
    }

    public function editPage($id)
    {
        $page = Page::findOrFail($id);

        if (auth()->user()->role == 'admin') {
            $authors = User::select('id', 'name')
                ->where('role', 'author')
                ->orderBy('name')
                ->get();
            return view('admin.pages.page-edit')
                ->with('authors', $authors)
                ->with('page', $page);
        }
        return view('admin.pages.page-edit')->with('page', $page);
    }

    public function updatePage(PageAddRequest $request, $id)
    {
        $this->validate(
            $request,
            [
                'slug' => 'unique:pages,slug,' . $id
            ],
            [
                'slug.unique' => 'Acest slug este deja utilizat in baza de date'
            ]
        );

        $page = Page::findOrFail($id);

        $page->title = $request->title;
        $page->slug = Str::slug($request->slug);


        $page->subtitle = $request->subtitle;

        $page->excerpt = $request->excerpt;
        $page->presentation = $request->presentation;
        $page->content = $request->content;

        $page->views = $request->views;

        if ($request->publish == 1) {

            $page->published_at = $request->published_at;
        } else {
            $page->published_at = null;
        }

        // ==== setarea autorului articolului de catre admin
        if (auth()->user()->role == 'admin') {
            $page->user_id = $request->user_id;
        }



        if ($request->hasFile('photo')) {
            if (!($page->photo == 'article.jpg')) {
                File::delete('images/pages/' . $page->photo);
            }

            $extension = $request->file('photo')->getClientOriginalExtension();
            $photoName = str_replace(' ', '', $request->title) . '_' . time() . '.' . $extension;

            $request->file('photo')->move('images/pages', $photoName);

            $page->photo = $photoName;
        }

        $mess = 'Articolul ' . $request->title . ' a fost actualizat cu succes! ';

        $page->save();

        return redirect(route('admin.pages'))->with('success', $mess);
    }

    public function showCategories($id)
    {
        $page = Page::findOrFail($id);
        $categories = Category::select('id', 'title')->orderBy('title')->get();

        return view('admin.pages.page-categories')
            ->with('categories', $categories)
            ->with('page', $page);
    }

    public function setCategories(Request $request, $id)
    {
        $page = Page::findOrfail($id);
        $page->categories()->sync($request->categs);

        $mess = 'Categoriile pentru ' . $page->title . ' au fost actualizate cu succes!';

        return redirect(route('admin.pages'))->with('success', $mess);
    }

    //=== Stergerea unui articol
    public function deletePage($id)
    {
        if (!Gate::allows('author-rights')) {
            return redirect(route('admin.pages'))->with('error', 'Nu aveti dreptul sa executati aceasta actiune');
        }

        $page = Page::findOrFail($id);
        if (!($page->photo == 'article.jpg')) {
            File::delete('images/pages/' . $page->photo);
        }

        // stergem toate imaginiledin galeria photo de pe hdd
        if ($page->photos()->count() > 0) {
            File::deleteDirectory('images/pages-photo/' . $page->id);
        }

        $page->categories()->detach();
        $page->delete();

        $mess = 'Articolul ' . $page->title . ' a fost sters din baza de date';

        return redirect(route('admin.pages'))->with('success', $mess);
    }
}
