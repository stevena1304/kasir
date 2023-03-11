@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">{{ __('History Transaction') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif


                    <table class="table table-responsive table-striped">
                        <thead>
                            <td>#</td>
                            <td>Date</td>
                            <td>Total</td>
                            <td>Pay Total</td>
                            <td class="col-md-2">Served By</td>
                            <td>Action</td>
                        </thead>
                        
                        @foreach ($transaction as $item)        
                        <tbody>
                            <td>{{$loop -> iteration}}</td>
                            <td>{{$item -> created_at}}</td>
                            <td>{{$item -> total}}</td>
                            <td>{{$item -> pay_total}}</td>
                            <td>
                                {{$item -> user -> name}}
                            <td>
                                <a href="{{route('transaction.show', $item->id)}}" class="btn btn-sm btn-primary">Detail</a>
                            </td>
                        </tbody>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
