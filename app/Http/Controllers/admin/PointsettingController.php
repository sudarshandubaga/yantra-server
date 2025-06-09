<?php

namespace App\Http\Controllers\admin;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use App\Models\Setting;
use App\Models\PointApply;

use Illuminate\Support\Facades\Storage;

class PointsettingController extends BaseController
{
    // edit record
    public function edit(Request $request)
    {
        $edit     = Setting::with('media')->find(1);
        $edit1    = PointApply::find(1);
        $image    =  !empty($edit->media) ? $edit->media->media : '';
        $edit_data = [
            'record' => $edit->toArray(),
            'record1' => $edit1->toArray()
        ];
        $edit_data['schedule'] = $edit_data['record']['schedule'];
        $request->replace($edit_data);
        //send to view
        $request->flash();
        // set page and title ------------------
        $page = 'pointsetting.edit';
        $title = 'Point Setting';
        $data = compact('page', 'title', 'edit');
        // return data to view

        return view('admin.layout', $data);
    }
    public function update(Request $request)
    {
        $record1         = PointApply::find(1);
        $input1          = $request->record1;
        $record1->fill($input1);
        $pointsetting = $record1->save();

        $record         = Setting::find(1);
        $input          = $request->record;
        $record->fill($input);
        if ($setting = $record->save()) {

            return redirect(url('restaurent-control/pointsetting'))->with('success', 'Success! Record has been edided');
        }
    }
}
