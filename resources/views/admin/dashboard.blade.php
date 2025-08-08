
@extends('layouts.admin')

@section('title', 'Dashboard Admin')

@section('content')
<div class="container">
    <h1>Dashboard Admin</h1>
    <p>Selamat datang di panel admin.</p>
    <a href="{{ route('admin.products') }}" class="btn btn-primary">kelola Produk</a>
</div>
@endsection
