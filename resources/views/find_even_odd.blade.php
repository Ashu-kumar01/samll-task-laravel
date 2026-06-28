<!DOCTYPE html>
<html>

<head>
    <title>Even Odd Checker</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f5f7fb;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .card {
            width: 400px;
            background: #fff;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, .1);
        }

        input {
            width: 100%;
            padding: 12px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 8px;
        }

        button {
            width: 100%;
            padding: 12px;
            border: none;
            background: #4f46e5;
            color: #fff;
            border-radius: 8px;
            cursor: pointer;
        }

        .badge {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 18px;
            border-radius: 30px;
            background: #10b981;
            color: #fff;
            font-weight: bold;
        }
    </style>
</head>

<body>

    <div class="card">

        <h2>Even / Odd Checker</h2>

        <form action="{{ route('check.number') }}" method="POST">
            @csrf

            <input type="number" name="number" placeholder="Enter a Number" required>

            <button type="submit">Check Number</button>
        </form>

        @if(session('result'))
            <div style="text-align:center">
                <div class="badge">
                    {{ session('number') }} is {{ session('result') }}  
                </div>
            </div>
        @endif

    </div>

</body>

</html>
