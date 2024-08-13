<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verify OTP</title>
</head>
<body>
    <h1>Verify OTP</h1>
    <form action="{{ route('verify.otp') }}" method="POST">
        @csrf
        <div>
            <label for="otp">Enter OTP:</label>
            <input type="text" name="otp" required>
        </div>
        <button type="submit">Verify</button>
    </form>
</body>
</html>
