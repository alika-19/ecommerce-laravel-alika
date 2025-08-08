<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Beranda - Toko Online</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{ route('home') }}">Toko Online</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse justify-content-end" id="navbarContent">
            <ul class="navbar-nav mb-2 mb-lg-0">
                @auth
                    @if(Auth::user()->is_admin)
                        <li class="nav-item me-2">
                            <a href="{{ route('admin.dashboard') }}" class="btn btn-warning btn-sm">Admin</a>
                        </li>
                    @endif
                    <li class="nav-item">
                        <form action="{{ route('logout') }}" method="POST" class="d-inline">
                            @csrf
                            <button class="btn btn-outline-light btn-sm">Logout</button>
                        </form>
                    </li>
                @else
                    <li class="nav-item me-2">
                        <a href="{{ route('login') }}" class="btn btn-outline-light btn-sm">Login</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('register') }}" class="btn btn-outline-light btn-sm">Register</a>
                    </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>

<!-- Konten Utama -->
<div class="container mt-5">
    <h2 class="mb-4">Daftar Produk</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <div class="row">
        @foreach($products as $product)
            <div class="col-md-4 mb-4">
                <div class="card h-100 shadow-sm">
                    <img src="{{ asset('storage/' . $product->image) }}" class="card-img-top" alt="{{ $product->name }}" style="height: 200px; object-fit: cover;">
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title">{{ $product->name }}</h5>
                        <p class="card-text">Harga: <strong>Rp{{ number_format($product->price, 0, ',', '.') }}</strong></p>

                        <!-- Stok -->
                        @if($product->stock > 0)
                            <p><span class="badge bg-success">Stok Tersisa: {{ $product->stock }}</span></p>
                        @else
                            <p><span class="badge bg-danger">Stok Habis</span></p>
                        @endif

                        <!-- Tombol Beli -->
                        <div class="mt-auto">
                            @auth
                                @if($product->stock > 0)
                                    <form action="{{ route('checkout.process') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="quantities[{{ $product->id }}]" value="1">
                                        <button class="btn btn-success w-100">Beli</button>
                                    </form>
                                @else
                                    <button class="btn btn-secondary w-100" disabled>Stok Habis</button>
                                @endif
                            @else
                                <a href="{{ route('login') }}" class="btn btn-primary w-100">Login untuk Beli</a>
                            @endauth
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
