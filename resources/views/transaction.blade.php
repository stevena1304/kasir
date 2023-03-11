@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Transaction') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif


                    <table class="table table-responsive table-striped">
                        <thead>
                            <td>#</td>
                            <td>Category</td>
                            <td>Name</td>
                            <td>Price</td>
                            <td>Stock</td>
                            <td>Action</td>
                        </thead>
                        @if ($items->isEmpty())
                            <tr>
                                <td colspan="6" class="text-center">All Item Is Empty</td>
                            </tr>
                        @endif

                        @foreach ($items as $item)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$item->category->name}}</td>
                            <td>{{$item->name}}</td>
                            <td>Rp. {{number_format($item->price) }}</td>
                            <td>{{$item->stock}}</td>
                            <td>
                                <form action="{{route('transaction.store')}}" method="post">
                                    @csrf
                                    <input type="hidden" name="item_id" value="{{$item->id}}">
                                    <input class="form-control" type="hidden" name="qty" value="1">
                                    <button type="submit" class="btn btn-sm btn-primary">Add to Cart</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card">
                <div class="card-header">{{ __('Cart') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <table class="table table-responsive">
                        <thead>
                            <td>#</td>
                            <td>Name</td>
                            <td class="col-md-3">Qty</td>
                            <td>Subtotal</td>
                            <td></td>
                        </thead>
                        @if($carts->isEmpty())
                            <tr>
                                <td colspan="5" class="text-center">Cart Empty</td>
                            </tr>
                        @else
                        @foreach($carts as $c)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$c->name}}</td>
                            <td>
                                <form action="{{route('transaction.update', $c->cart->id)}}" method="post">
                                    @csrf
                                    @method('PUT')
                                    <input type="number" name="qty" min="1" max="{{$c->stock + $c->cart->qty}}" onchange="update{{$loop->iteration}}()" value="{{$c->cart->qty}}">
                            </td>
                            <td>{{$c->price * $c->cart->qty}}</td>
                            <td>
                                    <input type="submit" class="btn btn-sm btn-warning" id="ubah{{$loop->iteration}}" style="display: none;" value="Update">
                                </form>
                                <form action="{{route('transaction.destroy', $c->cart->id)}}" method="post">
                                    @csrf
                                    @method('delete')
                                    <!-- <input type="hidden" name="id"> -->
                                    <input type="submit" class="btn btn-sm btn-danger" value="Hapus" id="hapus{{$loop->iteration}}" style="display: ">
                                </form>
                                <script>
                                    function update{{$loop->iteration}}(){
                                        document.getElementById("ubah{{$loop->iteration}}").style.display = "inline";
                                        document.getElementById("hapus{{$loop->iteration}}").style.display = "none";
                                    }
                                </script>
                            </td>
                        </tr>
                        @endforeach
                        @endif

                        <form action="{{route('transaction.checkout')}}" method="post">
                            @csrf
                            <input type="hidden" value="{{ Auth::user()->id }}" name="user_id">
                            <input type="hidden" name="date" value="{{ date('Y-m-d')}}">
                            <tr>
                                <td colspan="2">Total</td>
                                <td colspan="2"><input class="form-control" type="number" value="{{$carts->sum(function ($items) {return $items->price * $items->cart->qty;}) }}" readonly name="total"></td>
                            </tr>
                            <tr>
                                <td colspan="2">Payment</td>
                                <td colspan="2"><input class="form-control" type="number" min="{{$carts->sum(function($items) {return $items->price * $items->cart->qty;})}}" required name="pay_total"></td>
                            </tr>
                    </table>
                            <button type="submit" class="btn btn-primary text-light">Save</button>
                            <input type="reset" value="Cancel" class="btn btn-danger text-light">
                        </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
