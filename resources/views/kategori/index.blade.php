@extends('layouts.app')

@section('content')
<div class="container">

    @if($message = Session::get('success'))
    <div class="alert alert-success">
        <p>{{ $message }}</p>
    </div>
    @endif
    <div class="row justify-content-center">
        <div class="col-md-4 bg-white p-4">
            <form action="{{ route('kategori.store') }}" method="post">
            @csrf
                <div class="form-group">
                    <label for="name">Nama Kategori</label>
                    <input type="text" name="kategori" id="name" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-block btn-danger">Tambah Kategori</button>
            </form>
        </div>
        <div class="col-md-8 bg-white p-4">
            <h5>Data Kategori</h5>
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Kategori</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($kategoris as $index=>$kategori)
                    <tr>
                        <td>{{ $index + 1}}</td>
                        <td>{{ $kategori->kategori }}</td>
                        <td>
                            <a href="{{ route('kategori.edit', $kategori->id ) }}" class="btn btn-primary">Edit</a>
                            <form action="{{ route('kategori.destroy', $kategori->id ) }}" method="post">
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
