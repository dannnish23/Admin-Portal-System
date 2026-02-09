<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;

class ItemController extends Controller
{
    public function admin()
    {
        $items = Item::latest()->get();
        return view('admin', compact('items'));
    }

    public function user()
    {
        return view('user');
    }

    public function getItems()
    {
        return Item::orderBy('custom_time','desc')->get();
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required',
            'shape'=>'required',
            'color'=>'required',
            'custom_time'=>'required'
        ]);

        Item::create($request->all());

        return redirect('/admin')->with('success','Added!');
    }

    public function edit($id)
    {
        $item = Item::find($id);
        $items = Item::all();
        return view('admin', compact('item','items'));
    }

    public function update(Request $request, $id)
    {
        // ADD VALIDATION HERE
        $request->validate([
            'name' => 'required',
            'shape' => 'required',
            'color' => 'required',
            'custom_time' => 'required'
        ]);

        $item = Item::find($id);

        $item->name = $request->name;
        $item->shape = $request->shape;
        $item->color = $request->color;
        $item->custom_time = $request->custom_time;

        $item->save();

        return redirect('/admin')->with('success','Updated!');
    }

    public function delete($id)
    {
        Item::find($id)->delete();
        return redirect('/admin');
    }
}
