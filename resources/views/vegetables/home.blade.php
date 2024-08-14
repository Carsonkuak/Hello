<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Main Page</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        header {
            background-color: #333;
            color: #fff;
            padding: 10px 20px;
            text-align: center;
            position: relative;
        }
        header h1 {
            margin: 0;
            font-size: 2em;
        }
        .logout-button {
            position: absolute;
            top: 10px;
            left: 20px;
        }
        .logout-button form {
            display: inline;
        }
        .logout-button button {
            background-color: #dc3545;
            color: white;
            border: none;
            padding: 8px 16px;
            border-radius: 5px;
            cursor: pointer;
        }
        .logout-button button:hover {
            background-color: #c82333;
        }
        .container {
            width: 80%;
            margin: 0 auto;
            overflow: hidden;
            padding: 20px;
        }
        .products {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
        }
        .product {
            background: #fff;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
            padding: 10px;
            width: calc(33% - 20px);
            text-align: center;
        }
        .product img {
            width: 100px;
            height: 100px;
            object-fit: cover;
            border-radius: 5px;
        }
        .product p {
            margin: 10px 0;
            color: #333;
        }
        .product a {
            text-decoration: none;
            color: #333;
        }
        .product a:hover {
            color: #007bff;
        }
        .product-details {
            display: flex;
            flex-direction: column;
            align-items: center;
        }
    </style>
</head>
<body>
    <header>
        <div class="logout-button">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit">Logout</button>
            </form>
        </div>
        <div>
            <h1>Welcome</h1>
        </div>
    </header>

    <div class="container">
        <h2>Products</h2>
        <div class="products">
            @foreach ($products as $product)
                <div class="product">
                    <a href="{{ route('product.details', $product->id) }}">
                        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->p_name }}">
                        <p>{{ $product->p_name }}</p>
                        <p>${{ number_format($product->price, 2) }}</p>
                        <p>{{ $product->mass }} kg</p>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
</body>
</html>
