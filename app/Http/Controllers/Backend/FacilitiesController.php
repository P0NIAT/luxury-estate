<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Facilities;
use Illuminate\Http\Request;


class FacilitiesController extends Controller
{
    public function FacilitiesAll()
    {
        $facil = Facilities::latest()->get();
        return view('facilities.facilities_all', compact('facil'));
    }

    public function FacilitiesAddNew()
    {
        $facil = Facilities::latest()->get();
        return view('facilities.facilities_addnew', compact('facil'));
    }

    public function FacilitiesStore(Request $request)
    {
        $request->validate([
            'facilities_name' => 'required|max:100',
        ]);

        Facilities::insert([
            'facilities_name' => $request->facilities_name,
        ]);

        $notification = array(
            'message' => 'Property Facility Created Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('facilities.all')->with($notification);
    }

    public function FacilitiesEdit($id)
    {
        $facil = Facilities::findOrFail($id);
        return view('facilities.facilities_edit', compact('facil'));
    }

    public function FacilitiesUpdate(Request $request)
    {
        $fid = $request->id;

        Facilities::findOrFail($fid)->update([
            'facilities_name' => $request->facilities_name,
        ]);

        $notification = array(
            'message' => 'Property Facilities Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('facilities.all')->with($notification);
    }

    public function FacilitiesDelete($id)
    {
        Facilities::findOrFail($id)->delete();

        $notification = array(
            'message' => 'Property Facility Deleted Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }
}
