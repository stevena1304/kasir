@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Item') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="post" action="{{route('item.update', $items->id)}}">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <select class="form-control form-select" name="category_id" id="">
                                @foreach($categories as $category)
                                <option value="{{$category -> id}}" @if($category->id == $items->category->id) selected @endif>{{$category -> name}}</option>
                                @endforeach
                            </select><br>
                        </div>
                        <div class="form-group">
                            <input type="text" name="name" id="name" class="form-control" placeholder="Nama Item" value="{{$items->name}}" required><br>
                        </div>
                        <div class="form-group">
                            <input type="number" name="price" id="name" class="form-control" placeholder="Price" value="{{$items->price}}" required><br>
                        </div>
                        <div class="form-group">
                            <input type="number" name="stock" id="name" class="form-control" placeholder="Stock" value="{{$items->stock}}" required><br>
                        </div>
                        <div class="form-group">
                            <input type="submit"class="btn btn-sm btn-success" value="Simpan">
                            <a class="btn btn-sm btn-danger" href="{{route('item.index')}}">Batal</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
