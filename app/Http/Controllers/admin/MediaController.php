<?php

namespace App\Http\Controllers\admin;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
// Image Resize Library
use Intervention\Image\ImageManagerStatic as Image;
// Load Models
use App\Models\Media;

class MediaController extends BaseController
{
    public function index()
    {
        $lists = Media::orderBy('id', 'desc')->paginate(500);
        // set page and title ------------------

        $page  = 'media.list';
        $title = 'Media';
        $data  = compact('page', 'title', 'lists');
        // return data to view
        return view('admin.layout', $data);
    }
    public function add(Request $request)
    {
        $path = storage_path('app/public/media');
        if (!is_dir($path)) {
            mkdir($path, 0755, true);
        }

        $file       = $request->file('file');

        $ext        = $file->extension();
        $file_name  = uniqid() . '.' . $ext;

        $medium_dir    = storage_path("app/public/media/medium/");
        if (!is_dir($medium_dir)) {
            mkdir($medium_dir, 0755, true);
        }

        $medium_path  = storage_path("app/public/media/medium/" . $file_name);
        $image_resize = Image::make($file->getRealPath());
        $image_resize->resize(552, 406);
        $image_resize->save($medium_path);

        $thumb_dir    = storage_path("app/public/media/thumb/");
        if (!is_dir($thumb_dir)) {
            mkdir($thumb_dir, 0755, true);
        }

        $thumb_path   = storage_path("app/public/media/thumb/" . $file_name);
        $image_resize = Image::make($file->getRealPath());
        $image_resize->resize(262, 227);
        $image_resize->save($thumb_path);

        // Full Image (Original)
        $file->move($path, $file_name);

        $record        = new Media();
        $record->media = $file_name;
        if ($record->save()) {
            return response()->json([
                'status'        => 'Success',
                'name'          => url('storage/media/thumb/' . $file_name),
                'original_name' => $file->getClientOriginalName(),
                'id'            => $record->id,
            ]);
        } else {
            return response()->json([
                'status'        => 'Failed',
                'name'          => $file_name,
                'original_name' => $file->getClientOriginalName(),
            ]);
        }
    }
    // edit record
    public function edit(Request $request)
    {
        static $id = 1;
        $edit      = Media::find($id);
        $edit_data = ['record' => $edit->toArray()];
        $request->replace($edit_data);
        //send to view
        $request->flash();
        // set page and title ------------------
        $page = 'media.edit';
        $title = 'Media';
        $data = compact('page', 'title', 'id');
        // return data to view

        return view('admin.layout', $data);
    }
    public function update(Request $request, $id)
    {
        $record         = Media::find($id);
        $input          = $request->record;
        $record->fill($input);
        if ($record->save()) {
            return redirect(url('restaurent-control/media'))->with('success', 'Success! Record has been edided');
        }
    }
    public function destroy(Media $row)
    {
        $row->delete();
        return redirect()->back()->with('success', 'Success! Record has been deleted');
    }

    public function destroyAll(Request $request)
    {
        $ids = $request->ids;
    }
}
