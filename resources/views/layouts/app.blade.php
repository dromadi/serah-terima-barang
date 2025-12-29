<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tools Lifecycle Hub – TRL</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container-fluid">
        <a class="navbar-brand" href="/dashboard">TRL Hub</a>
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav me-auto">
                <li class="nav-item"><a class="nav-link" href="/tools">Tools</a></li>
                <li class="nav-item"><a class="nav-link" href="/borrow">Peminjaman</a></li>
                <li class="nav-item"><a class="nav-link" href="/damage">Kerusakan</a></li>
                <li class="nav-item"><a class="nav-link" href="/repairs">Perbaikan</a></li>
                <li class="nav-item"><a class="nav-link" href="/reports">Laporan</a></li>
            </ul>
            <form action="/logout" method="post">
                @csrf
                <button class="btn btn-sm btn-light">Logout</button>
            </form>
        </div>
    </div>
</nav>
<main class="container py-4">
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    @yield('content')
</main>
</body>
</html>
