<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Product Details</title>
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
        .product-info {
            width: 80%;
            margin: 20px auto;
            padding: 20px;
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            text-align: center;
        }
        .product-info img {
            width: 100%;
            max-width: 300px;
            height: auto;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        .product-info p {
            margin: 10px 0;
            font-size: 1.1em;
            color: #333;
        }
        .input-group {
            margin: 20px 0;
        }
        .input-group label {
            display: block;
            font-size: 1.1em;
            margin-bottom: 5px;
            color: #333;
        }
        .input-group input {
            width: 100%;
            max-width: 300px;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 1em;
        }
        .input-group input:focus {
            border-color: #007bff;
            outline: none;
        }
        .product-info button {
            padding: 10px 20px;
            font-size: 1.1em;
            color: #fff;
            background-color: #007bff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin-top: 20px;
        }
        .product-info button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <header>
        <div>
            <h1>{{ $product->p_name }}</h1>
        </div>
    </header>

    <div class="product-info">
        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->p_name }}">
        <p><strong>Price:</strong> ${{ number_format($product->price, 2) }}</p>
        <p><strong>Mass:</strong> {{ $product->mass }} kg</p>
        <p><strong>Details:</strong> {{ $product->details }}</p>

        @php
            $pricePerMass = $product->price / $product->mass;
        @endphp

        <div class="input-group">
            <label for="desiredMass">Enter desired mass (kg):</label>
            <input type="number" id="desiredMass" name="desiredMass" min="0" step="any" placeholder="Enter mass" oninput="updateTotalPrice()">
        </div>

        <p><strong>Total Price:</strong> $<span id="totalPrice">0.00</span></p>

        <button id="addcart">Add To Cart</button>
        <button id="checkoutButton">Check Out</button> <br>
        <button><a href="/vege_home">Back Home</a></button>
    </div>
   
    <script>
        function updateTotalPrice() {
            const pricePerMass = @json($pricePerMass);
            const desiredMass = parseFloat(document.getElementById('desiredMass').value) || 0;
            const totalPrice = (pricePerMass * desiredMass).toFixed(2);
            document.getElementById('totalPrice').textContent = totalPrice;
        }
    
        document.getElementById('checkoutButton').addEventListener('click', function() {
            const desiredMass = parseFloat(document.getElementById('desiredMass').value) || 0;
            if (desiredMass > 0) {
                alert('Proceeding to checkout with mass: ' + desiredMass);
            } else {
                alert('Please enter a valid mass.');
            }
        });
    
        document.getElementById('addcart').addEventListener('click', function() {
            const desiredMass = parseFloat(document.getElementById('desiredMass').value) || 0;
            if (desiredMass > 0) {
                fetch('{{ route("cart.add", $product->id) }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        mass: desiredMass
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert('Product added to cart successfully!');
                    } else {
                        alert('Failed to add product to cart.');
                    }
                });
            } else {
                alert('Please enter a valid mass.');
            }
        });
    </script>
</body>
</html>
