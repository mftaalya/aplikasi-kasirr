@extends('layouts.app')

@section('content')
    <div class="container">

        @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
        @endif
        <div class="row justify-content-center">
            <div class="col-md-4 bg-white p-4">
                <form action="{{ route('product.store') }}" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="name">Nama Produk</label>
                        <input type="text" name="name" id="name" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Kategori</label>
                        <select name="kategori_id" class="form-control" required>
                            <option value="" hidden="">--- Pilih Kategori ---</option>
                            @foreach ($kategoris as $p)
                                <option value="{{ $p->id }}">{{ $p->kategori }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="price">Harga</label>
                        <input type="number" name="price" id="price" class="form-control" required>
                    </div>
                    <button type="submit" class="btn btn-block btn-primary">Tambah Produk</button>
                </form>
            </div>
            <div class="col-md-8 bg-white p-4">
                <h5>Data Produk</h5>
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Produk</th>
                            <th>Kategori</th>
                            <th>Harga</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($products as $index=>$product)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $product->name }}</td>
                                <td>{{ $product->kategori->kategori }}</td>
                                <td>{{ $product->price }}</td>
                                <td>
                                    <a href="{{ route('product.edit', $product->id) }}" class="btn btn-primary">Edit</a>
                                    <form action="{{ route('product.destroy', $product->id) }}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class=" btn btn-danger">Hapus</button>
                                    </form>
                                    </th>
                                @empty
                                <td colspan="5">Data tidak ditemukan!</th>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
