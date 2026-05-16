<!DOCTYPE html>
<html lang="lt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Telefono numerio validacija</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

<div class="container mt-5">

    <div class="card shadow-sm">

        <div class="card-header bg-primary text-white">
            <h4>Telefono numerio validacija</h4>
        </div>

        <div class="card-body">

            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            @if($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="/phone-validation">

                @csrf

                <div class="mb-3">
                    <label for="phone" class="form-label">
                        Telefono numeris
                    </label>

                    <input
                        type="text"
                        name="phone"
                        id="phone"
                        class="form-control"
                        value="{{ old('phone') }}"
                        placeholder="pvz. +37061234567"
                    >
                </div>

                <button type="submit" class="btn btn-primary">
                    Tikrinti
                </button>

            </form>

        </div>

    </div>

</div>

</body>
</html>