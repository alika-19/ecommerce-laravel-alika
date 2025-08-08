<!DOCTYPE html>
<html>
<head>
    <title>Checkout</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container py-5">
    <h1 class="mb-4">Form Checkout</h1>

    {{-- Tampilkan pesan sukses atau error --}}
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if (session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <form action="{{ route('checkout.process') }}" method="POST">
        @csrf
        <div class="row">
            @foreach($products as $product)
                <div class="col-md-4 mb-4">
                    <div class="card h-100">
                        <img src="https://via.placeholder.com/150" alt="{{ $product->name }}" class="card-img-top">
                        <div class="card-body">
                            <h5 class="card-title">{{ $product->name }}</h5>
                            <p class="card-text">Harga: Rp{{ number_format($product->price, 0, ',', '.') }}</p>
                            <div class="form-group">
                                <label for="qty_{{ $product->id }}">Jumlah:</label>
                                <input type="number" name="quantities[{{ $product->id }}]" id="qty_{{ $product->id }}" class="form-control" value="1" min="0" max="{{ $product->stock }}">
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <button type="submit" class="btn btn-success">Checkout</button>
    </form>
</div>
</body>
</html>
