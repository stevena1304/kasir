@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">{{ __('Detail Transaction') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <table class="table">
                        <tr>
                            <td class="col-md-2">Date</td>
                            <td>{{ $detail->created_at }}</td>
                        </tr>
                        <tr>
                            <td class="col-md-2">Served by</td>
                            <td>{{ $detail->user->name }}</td>
                        </tr>
                    </table>

                    <hr>

                    <table class="table table-bordered">
                        <thead>
                            <td>#</td>
                            <td>Item Name</td>
                            <td>Qty</td>
                            <td>Price</td>
                            <td>Subtotal</td>
                        </thead>
                        
                        @foreach ($detail->detail as $item)
                            <tbody>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->qty }}</td>
                                <td>{{ $item->item->price }}</td>
                                <td>
                                    {{ $item->item->price * $item->qty }}
                                </td>
                        @endforeach
                            </tbody>
                        <tr>
                            <td colspan="4" class="text-end">Grand Total</td>
                            <td>{{ $detail -> total}}</td>
                        </tr>
                        <tr>
                            <td colspan="4" class="text-end">PayTotal</td>
                            <td>{{$detail -> pay_total}}</td>
                        </tr>
                        <tr>
                            <td colspan="4" class="text-end">Change</td>
                            <td>{{$detail -> pay_total - $detail ->total}}</td>
                        </tr>>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
