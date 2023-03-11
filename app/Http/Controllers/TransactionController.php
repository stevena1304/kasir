<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Item;
use App\Models\Transaction;
use App\Models\TransactionDetail;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = Item::doesnthave('cart')->where('stock', '>', 0)->get();
        $carts = Item::has('cart')->get()->sortByDesc('cart.created_at');
        return view('transaction', compact('items', 'carts'));
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
        Cart::create($request->all());
        return redirect()->back()->with('status', 'item berhasil dimasukkan keranjang');
    }

    public function checkout(Request $request)
    {
        Transaction::create($request->all());
        $carts = Cart::all();
        $transaction = Transaction::latest()->first()->id;

        foreach($carts as $cart){
            TransactionDetail::create([
                'transaction_id'=>$transaction,
                'item_id'=>$cart->item_id,
                'qty'=>$cart->qty,
                'subtotal'=>$cart->item->price*$cart->qty,
            ]);
        }

        Cart::truncate();
        return redirect(route('transaction.show', $transaction));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function history()
    {
        $transaction = Transaction::all();
        return view('history', compact('transaction'));
    }

    public function show($id)
    {
        $detail = Transaction::find($id);
        return view('detail', compact('detail'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        $items = Cart::find($id);
        $items->update($request->all());
        return redirect('transaction')->with('status', 'qty update');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $items = Cart::find($id);
        $items->delete();
        return redirect()->back()->with('status', 'item berhasil dihapus dari keranjang');
    }
}
