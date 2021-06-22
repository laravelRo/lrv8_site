<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Page;
use App\Models\Photo;
use Illuminate\Support\Str;
use App\Http\Requests\PhotosUploadRequest;
use App\Http\Requests\PhotoUpdateRequest;
use Illuminate\Support\Facades\File;


class PhotoController extends Controller
{
    //
    public function showForm($id)
    {
        $page = Page::findOrFail($id);

        return view('admin.pages.page-photos')->with('page', $page);
    }

    public function uploadPhotos(PhotosUploadRequest $request, $id)
    {


        if ($request->hasFile('photo')) {
            $page = Page::findOrFail($id);

            $itr = $page->maxPosition() + 10;

            foreach ($request->photo as $image) {
                $photo = new Photo;

                $extension = $image->getClientOriginalExtension();
                $photoName = $itr . '_' . time() . Str::random(5) . '.' . $extension;

                $image->move('images/pages-photo/' . $id . '/', $photoName);

                $photo->page_id = $id;
                $photo->file = $photoName;
                $photo->position = $itr;

                $photo->save();

                $itr = $itr + 10;
            }
            return back()->with('success', 'Fotografiile au fost incarcate cu succes!');
        }
        return back();
    }

    public function savePhoto(PhotoUpdateRequest $request, $id)
    {
        $photo = Photo::findOrFail($id);

        if (request('title')) {
            $photo->title = $request->title;
        }
        if (request('description')) {
            $photo->description = $request->description;
        }

        $photo->position = $request->position;

        if (request('publish')) {
            $photo->publish = $request->publish;
        } else {
            $photo->publish = 0;
        }

        if ($request->hasFile('photo')) {

            if (File::exists($photo->file_path())) {
                File::delete($photo->file_path());
            }


            $extension = $request->file('photo')->getClientOriginalExtension();
            $photoName = $request->position . '_' . time() . Str::random(5) . '.' . $extension;

            $request->file('photo')->move('images/pages-photo/' . $photo->page_id . '/', $photoName);

            $photo->file = $photoName;
        }
        $photo->save();
        return back()->with('success', 'Fotografia a fost actualizata cu succes!');
    }

    //=== stergem toata galeria foto a unei pagini
    public function deleteAllPhotos($id)
    {
        $page = Page::findOrFail($id);

        if ($page->photos()->count() > 0) {
            $photos = Photo::where('page_id', $page->id)->get();
            foreach ($photos as $photo) {
                $photo->delete();
            }
            File::deleteDirectory('images/pages-photo/' . $page->id);

            return back()->with('success', 'Galeria foto a fost stearsa');
        }
        return back()->with('success', 'Nu exista fotografii care sa fie sterse');
    }

    // === stergem o singura fotografie din galerie
    public function deletePhoto($id)
    {
        $photo = Photo::findOrFail($id);

        if (File::exists($photo->file_path())) {
            File::delete($photo->file_path());
        }

        $photo->delete();
        return back()->with('success', 'Fotografia a fost stearsa din baza de date');
    }
}
