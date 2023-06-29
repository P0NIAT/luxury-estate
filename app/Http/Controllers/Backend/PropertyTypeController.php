<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\PropertyType;
use Illuminate\Http\Request;

class PropertyTypeController extends Controller
{
    public function TypeAll()
    {
        $types = PropertyType::latest()->get();
        return view('type.type_all', compact('types'));
    }

    public function TypeAddNew()
    {
        $types = PropertyType::latest()->get();
        return view('type.type_addnew', compact('types'));
    }

    public function TypeStore(Request $request)
    {
        $request->validate([
            'type_name' => 'required|unique:property_types|max:200',
            'type_icon' => 'required'
        ]);

        PropertyType::insert([
            'type_name' => $request->type_name,
            'type_icon' => $request->type_icon
        ]);

        $notification = array(
            'message' => 'Property Type Created Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('type.all')->with($notification);
    }

    public function TypeEdit($id)
    {
        $types = PropertyType::findOrFail($id);
        return view('type.type_edit', compact('types'));
    }

    public function TypeUpdate(Request $request)
    {
        $pid = $request->id;

        PropertyType::findOrFail($pid)->update([
            'type_name' => $request->type_name,
            'type_icon' => $request->type_icon
        ]);

        $notification = array(
            'message' => 'Property Type Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('type.all')->with($notification);
    }

    public function TypeDelete($id)
    {
        PropertyType::findOrFail($id)->delete();

        $notification = array(
            'message' => 'Property Type Deleted Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }
}
