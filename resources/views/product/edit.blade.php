@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-4 bg-white p-4">
                <form action="{{ route('product.update', $product->id) }}" method="post">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="name">Nama Produk</label>
                        <input type="text" name="name" id="name" class="form-control" value="{{ $product->name }}">
                    </div>
                    <div class="form-group">
                        <label>Kategori</label>
                        <select name="kategori_id" class="form-control" required>
                            <option value="{{ $product->kategori_id }}">{{ $product->kategori->kategori }}</option>
                            @foreach ($kategori as $p)
                                <option value="{{ $p->id }}">{{ $p->kategori }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="price">Harga</label>
                        <input type="number" name="price" id="price" class="form-control"
                            value="{{ $product->price }}">
                    </div>
                    <button type="submit" class="btn btn-block btn-primary">Update Produk</button>
                </form>
            </div>
        </div>
    </div>
@endsection
