@extends('layouts.app')

@section('content')

@if($message = Session::get('berhasil'))
    <div class="alert alert-success alert-block">
        <button type="button" class="close" data-dismiss="alert">X</button>
        <strong>{{ $message  }} </strong>                       
    </div>
@endif

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Category') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="post" action="{{route('category.update', $category->id)}}">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <input type="text" name="name" id="name" class="form-control" value="{{$category->name}}" required><br>
                        </div>
                        <div class="form-group">
                            <input type="submit"class="btn btn-sm btn-success" value="Simpan">
                            <a class="btn btn-sm btn-danger" href="/category">Batal</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
