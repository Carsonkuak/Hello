<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Product Details</title>
</head>
<body>
    <header>
        <div>
            <h1>{{ $product->p_name }}</h1>
        </div>
    </header>

    <div>
        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->p_name }}" style="width: 300px; height: 300px;">
        <p><strong>Price:</strong> {{ $product->price }}</p>
        <p><strong>Mass:</strong> {{ $product->mass }}</p>
        <p><strong>Details:</strong> {{ $product->details }}</p>
        <p><strong>Created At:</strong> {{ $product->created_at }}</p>
        <p><strong>Updated At:</strong> {{ $product->updated_at }}</p>
    </div>
</body>
</html>
