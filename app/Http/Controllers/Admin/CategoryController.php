<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Http\Requests\CategoryAddRequest;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Gate;

class CategoryController extends Controller
{
    public function showCategories()
    {
        $categories = Category::all()->sortBy('title');
        return view('admin.category.categories')->with('categories', $categories);
    }

    public function newCategory()
    {
        if (!Gate::allows('author-rights')) {
            return redirect(route('admin.categories'))->with('error', 'Nu aveti dreptul sa executati aceasta actiune');
        }
        return view('admin.category.category-new');
    }

    public function addCategory(CategoryAddRequest $request)
    {
        if (!Gate::allows('author-rights')) {
            return redirect(route('admin.categories'))->with('error', 'Nu aveti dreptul sa executati aceasta actiune');
        }
        $this->validate(
            $request,
            [
                'slug' => 'unique:categories,slug'
            ],
            [
                'slug.unique' => 'Acest slug este deja utilizat in baza de date'
            ]
        );
        $category = new Category;

        $category->title = $request->title;
        $category->slug = Str::slug($request->slug);
        $category->subtitle = $request->subtitle;
        $category->excerpt = $request->excerpt;
        $category->views = $request->views;

        $category->position = $request->position;
        $category->publish = $request->publish;

        $category->meta_title = $request->meta_title;
        $category->meta_description = $request->meta_description;
        $category->meta_keywords = $request->meta_keywords;


        if ($request->hasFile('photo')) {
            $extension = $request->file('photo')->getClientOriginalExtension();
            $photoName = str_replace(' ', '', $request->title) . '_' . time() . '.' . $extension;

            $request->file('photo')->move('images/categories', $photoName);

            $category->photo = $photoName;
        }
        $mess = 'Categoria ' . $request->title . ' a fost inregistrata in baza de date. ';

        $category->save();

        return redirect(route('admin.categories'))->with('success', $mess);
    }

    // ===>drepturi editor ===
    public function editCategory($id)
    {

        $category = Category::findOrFail($id);
        return view('admin.category.category-edit')->with('category', $category);
    }

    public function updateCategory(CategoryAddRequest $request, $id)
    {


        $this->validate(
            $request,
            [
                'slug' => 'unique:categories,slug,' . $id
            ],
            [
                'slug.unique' => 'Acest slug este deja utilizat in baza de date'
            ]
        );

        $category = Category::findOrFail($id);

        $category->title = $request->title;
        $category->slug = Str::slug($request->slug);
        $category->subtitle = $request->subtitle;
        $category->excerpt = $request->excerpt;
        $category->views = $request->views;

        $category->position = $request->position;
        $category->publish = $request->publish;

        $category->meta_title = $request->meta_title;
        $category->meta_description = $request->meta_description;
        $category->meta_keywords = $request->meta_keywords;


        if ($request->hasFile('photo')) {
            if (!($category->photo == 'category.jpg')) {
                File::delete('images/categories/' . $category->photo);
            }

            $extension = $request->file('photo')->getClientOriginalExtension();
            $photoName = str_replace(' ', '', $request->title) . '_' . time() . '.' . $extension;

            $request->file('photo')->move('images/categories', $photoName);

            $category->photo = $photoName;
        }
        $mess = 'Categoria ' . $request->title . ' a fost actualizata cu noile date. ';

        $category->save();

        return redirect(route('admin.categories'))->with('success', $mess);
    }
    // <=== drepturi editor ===

    public function deleteCategory($id)
    {
        if (!Gate::allows('author-rights')) {
            return redirect(route('admin.categories'))->with('error', 'Nu aveti dreptul sa executati aceasta actiune');
        }
        $category = Category::findOrFail($id);

        if (!($category->photo == 'category.jpg')) {
            File::delete('images/categories/' . $category->photo);
        }

        $category->pages()->detach();

        $category->delete();
        return redirect(route('admin.categories'))->with('success', 'Categoria ' . $category->title . ' a fost stearsa definitiv din baza de date');
    }
}
