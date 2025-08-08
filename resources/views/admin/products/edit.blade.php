@extends('layouts.admin')

@section('title', 'Edit Produk')

@section('content')
<div class="container">
    <h1>Edit Produk</h1>

    <form method="POST" action="{{ route('admin.products.update', $product->id) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">Nama Produk</label>
            <input type="text" name="name" class="form-control" value="{{ $product->name }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Harga</label>
            <input type="number" name="price" class="form-control" value="{{ $product->price }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Stok</label>
            <input type="number" name="stock" class="form-control" value="{{ $product->stock }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Ganti Gambar</label>
            <input type="file" name="image" class="form-control">
        </div>

        <button class="btn btn-primary" type="submit">Update</button>
        <a href="{{ route('admin.products') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection
