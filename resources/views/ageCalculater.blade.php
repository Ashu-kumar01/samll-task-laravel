<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Age Calculator</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: linear-gradient(135deg, #4F46E5, #7C3AED, #06B6D4);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .card {
            width: 450px;
            border: none;
            border-radius: 20px;
            padding: 20px;
            box-shadow: 0 15px 40px rgba(0, 0, 0, .2);
        }

        .badge-custom {
            font-size: 18px;
            padding: 15px 25px;
        }
    </style>

</head>

<body>

    <div class="card">

        <h2 class="text-center mb-3">🎂 Age Calculator</h2>

        <form action="{{ route('age.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label class="form-label">Date of Birth</label>

                <input type="date" name="dob" class="form-control @error('dob') is-invalid @enderror"
                    value="{{ old('dob') }}">

                @error('dob')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror

            </div>

            <button class="btn btn-primary w-100">
                Calculate Age
            </button>

        </form>

        @if (session('age'))
            <div class="text-center mt-4">

                <span class="badge bg-success badge-custom">
                    🎉 Your Age is {{ session('age') }} Years
                </span>

            </div>
        @endif

    </div>

</body>

</html>
