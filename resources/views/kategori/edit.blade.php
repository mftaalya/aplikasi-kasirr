@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-4 bg-white p-4">
                <form action="{{ route('kategori.update', $kategori->id) }}" method="post">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="name">Nama Kategori</label>
                        <input type="text" name="kategori" id="name" class="form-control" value="{{ $kategori->kategori }}">
                    </div>
                    <button type="submit" class="btn btn-block btn-primary">Update Produk</button>
                </form>
            </div>
        </div>
    </div>
@endsection
