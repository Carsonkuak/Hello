<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Cart</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        header {
            background-color: #333;
            color: #fff;
            padding: 15px 0;
            text-align: center;
        }
        header h1 {
            margin: 0;
            font-size: 2.5em;
        }
        .cart-container {
            width: 80%;
            margin: 20px auto;
            padding: 20px;
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .cart-item {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
        }
        .cart-item img {
            width: 100px;
            height: auto;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        .cart-item-info {
            flex: 1;
            margin-left: 20px;
        }
        .cart-item-info p {
            margin: 5px 0;
            font-size: 1.1em;
            color: #333;
        }
        .cart-item-total {
            font-size: 1.2em;
            color: #333;
            font-weight: bold;
        }
        .cart-summary {
            text-align: right;
            font-size: 1.3em;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <header>
        <div>
            <h1>Your Cart</h1>
        </div>
    </header>

    <div class="cart-container">
        @foreach ($cartItems as $item)
            <div class="cart-item">
                <img src="{{ asset('storage/' . $item->vegeProduct->image) }}" alt="{{ $item->vegeProduct->p_name }}">
                <div class="cart-item-info">
                    <p><strong>{{ $item->vegeProduct->p_name }}</strong></p>
                    <p>Mass: {{ $item->mass }} kg</p>
                    <p>Price: ${{ number_format($item->price, 2) }}</p>
                </div>
                <div class="cart-item-total">
                    ${{ number_format($item->price, 2) }}
                </div>
            </div>
        @endforeach

        <div class="cart-summary">
            <p>Total: ${{ number_format($cartItems->sum('price'), 2) }}</p>
        </div>
    </div>
</body>
</html>
