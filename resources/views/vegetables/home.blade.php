<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Main Page</title>
</head>
<body>
    <header>
        <div>
            <h1>Welcome</h1>
        </div>
    </header>

    <div>
        <h2>Products</h2>
        <ul>
            @foreach ($products as $product)
                <li>
                    <a href="{{ route('product.details', $product->id) }}">
                        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->p_name }}" style="width: 100px; height: 100px;">
                        <p>{{ $product->p_name }}</p>
                        <p>{{ $product->price }}</p>
                        <p>{{ $product->mass }}</p>
                    </a>
                </li>
            @endforeach
        </ul>
    </div>
</body>
</html>
