@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Master Category') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif


                    <table class="table table-responsive table-striped">
                        <thead>
                            <td>#</td>
                            <td>Name</td>
                            <td>Action</td>
                        </thead>
                        @foreach($data as $category)
                        <tr>
                            <td>{{$loop -> iteration}}</td>
                            <td>{{$category -> name}}</td>
                            <td>
                                <a class="btn btn-sm btn-warning" href="{{route('category.edit', $category -> id)}}">Edit</a>
                                <a class="btn btn-sm btn-danger" href="{{route('category.hapus', $category -> id)}}">Delete</a>
                            </td>
                        </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card">
                <div class="card-header">{{ __('Category') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="post" action="{{route('category.store')}}">
                        @csrf
                        <div class="form-group">
                            <input type="text" name="name" id="name" class="form-control" placeholder="Nama Category" required><br>
                        </div>
                        <div class="form-group">
                            <input type="submit"class="btn btn-sm btn-success" value="Simpan">
                            <input type="reset" class="btn btn-sm btn-danger" value="Batal">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
