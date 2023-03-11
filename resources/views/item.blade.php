@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Master Item') }}</div>

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
                        
                        @foreach ($items as $item)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$item->category->name}}</td>
                            <td>{{$item->name}}</td>
                            <td>Rp.{{number_format ($item->price) }}</td>
                            <td>{{$item->stock}}</td>
                            <td>
                                <form method="post" action="{{route('item.destroy', $item->id)}}">
                                    @csrf
                                    @method('delete')
                                    <a class="btn btn-sm btn-warning" href="{{route('item.edit', $item->id)}}">Edit</a>
                                    <button type="submit" class="btn btn-sm btn-danger">Delete</button>
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
                <div class="card-header">{{ __('Add Item') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="post" action="{{route('item.store')}}">
                        @csrf
                        <div class="form-group">
                            <select class="form-control form-select" name="category_id" id="">
                                @foreach($categories as $category)
                                <option value="{{$category -> id}}">{{$category -> name}}</option>
                                @endforeach
                            </select><br>
                        </div>
                        <div class="form-group">
                            <input type="text" name="name" id="name" class="form-control" placeholder="Nama Item" required><br>
                        </div>
                        <div class="form-group">
                            <input type="number" name="price" id="name" class="form-control" placeholder="Price" required><br>
                        </div>
                        <div class="form-group">
                            <input type="number" name="stock" id="name" class="form-control" placeholder="Stock" required><br>
                        </div>
                        <div class="form-group">
                            <input type="submit"class="btn btn-sm btn-success" value="Simpan">
                            <buttton class="btn btn-sm btn-danger" type="reset">Batal</buttton>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
