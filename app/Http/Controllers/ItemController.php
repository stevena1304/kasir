<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\Category;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = Item::all();
        $categories = Category::all();
        return view('item', compact('items', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'category_id'=> 'required',
            'name'=> 'required',
            'price'=> 'required|numeric',
            'stock'=> 'required|numeric',
        ]);

        Item::create([
            'category_id'=>$request->category_id,
            'name'=>$request->name,
            'price'=>$request->price,
            'stock'=>$request->stock,
        ]);

        return redirect()->back()->with('status', 'item berhasil disimpan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $categories = Category::all();
        $items = Item::find($id);
        return view('item-edit', compact('categories', 'items'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'category_id'=>'required',
            'name'=>'required',
            'price'=>'required|numeric',
            'stock'=>'required|numeric',

        ]);

        $items = Item::find($id);
        $items->update($request->all());
        return redirect('item')->with('status', 'item berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Item::destroy($id);
        return redirect()->back()->with('status', 'item berhasil dihapus');
    }
}
