<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tools Lifecycle Hub – TRL</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <style>
        :root {
            color-scheme: dark;
            --trl-bg: #0b0f1a;
            --trl-panel: #101724;
            --trl-card: #111b2b;
            --trl-border: rgba(148, 163, 184, 0.2);
            --trl-muted: #94a3b8;
            --trl-primary: #3b82f6;
        }

        body {
            background: var(--trl-bg);
            color: #f8fafc;
            font-family: "Inter", "Segoe UI", system-ui, sans-serif;
            min-height: 100vh;
        }

        .app-shell {
            display: flex;
            min-height: 100vh;
        }

        .sidebar {
            width: 270px;
            background: linear-gradient(180deg, #0b1220 0%, #0a0f1a 100%);
            border-right: 1px solid var(--trl-border);
            padding: 24px 20px;
            display: flex;
            flex-direction: column;
            gap: 24px;
        }

        .sidebar-brand {
            display: flex;
            align-items: center;
            gap: 14px;
        }

        .sidebar-brand .icon {
            width: 44px;
            height: 44px;
            border-radius: 14px;
            background: var(--trl-primary);
            display: grid;
            place-items: center;
            font-size: 22px;
        }

        .sidebar-brand small {
            color: var(--trl-muted);
        }

        .nav-section {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .nav-section .nav-link {
            color: var(--trl-muted);
            border-radius: 12px;
            padding: 10px 14px;
            display: flex;
            align-items: center;
            gap: 12px;
            font-weight: 500;
        }

        .nav-section .nav-link.active,
        .nav-section .nav-link:hover {
            background: rgba(59, 130, 246, 0.15);
            color: #e2e8f0;
        }

        .sidebar-user {
            margin-top: auto;
            padding-top: 18px;
            border-top: 1px solid var(--trl-border);
        }

        .sidebar-user .avatar {
            width: 42px;
            height: 42px;
            border-radius: 50%;
            background: rgba(59, 130, 246, 0.2);
            display: grid;
            place-items: center;
            font-weight: 600;
            color: #c7d2fe;
        }

        .main-panel {
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        .topbar {
            border-bottom: 1px solid var(--trl-border);
            padding: 20px 32px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            background: rgba(11, 15, 26, 0.9);
            backdrop-filter: blur(10px);
        }

        .topbar-title h5,
        .topbar-title h6 {
            margin-bottom: 4px;
            font-weight: 600;
        }

        .topbar-title span {
            color: var(--trl-muted);
            font-size: 0.95rem;
        }

        .topbar-actions {
            display: flex;
            align-items: center;
            gap: 16px;
        }

        .search-input-group {
            background: #1b2332;
            border: 1px solid transparent;
            border-radius: 12px;
            padding: 4px 12px;
            display: flex;
            align-items: center;
            gap: 8px;
            width: 320px;
        }

        .search-input-group:focus-within {
            border-color: var(--trl-primary);
            box-shadow: 0 0 0 0.2rem rgba(59, 130, 246, 0.2);
        }

        .search-input {
            background: transparent;
            border: none;
            color: #e2e8f0;
            width: 100%;
        }

        .search-input::placeholder {
            color: #94a3b8;
        }

        .notification {
            position: relative;
            font-size: 22px;
            color: #e2e8f0;
        }

        .notification .badge {
            position: absolute;
            top: -6px;
            right: -8px;
            background: #ef4444;
            color: #fff;
            font-size: 10px;
        }

        .content-wrapper {
            padding: 28px 32px 40px;
        }

        .card-dark {
            background: var(--trl-card);
            border: 1px solid var(--trl-border);
            border-radius: 16px;
            box-shadow: 0 20px 40px rgba(5, 8, 15, 0.35);
            color: #f8fafc;
        }

        .card-dark h6 {
            color: var(--trl-muted);
        }

        .page-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 16px;
            margin-bottom: 24px;
        }

        .breadcrumb-trail {
            color: var(--trl-muted);
            font-size: 0.95rem;
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 8px;
        }

        .breadcrumb-trail i {
            color: #94a3b8;
        }

        .section-subtitle {
            color: var(--trl-muted);
        }

        .filter-panel {
            background: #0f172a;
            border: 1px solid var(--trl-border);
            border-radius: 14px;
            padding: 14px;
        }

        .soft-input {
            background: #1b2332;
            border: none;
            color: #e2e8f0;
            border-radius: 12px;
        }

        .soft-input:focus {
            background: #1b2332;
            border-color: var(--trl-primary);
            box-shadow: 0 0 0 0.2rem rgba(59, 130, 246, 0.2);
            color: #e2e8f0;
        }

        .pill-tabs .nav-link {
            color: var(--trl-muted);
            background: #1b2332;
            border-radius: 10px;
            padding: 8px 16px;
            border: none;
        }

        .pill-tabs .nav-link.active {
            color: #fff;
            background: #0b1220;
            border: 1px solid var(--trl-border);
        }

        .empty-state {
            text-align: center;
            padding: 48px 16px;
            color: var(--trl-muted);
        }

        .empty-state .icon {
            width: 64px;
            height: 64px;
            border-radius: 50%;
            background: #1b2332;
            display: grid;
            place-items: center;
            margin: 0 auto 16px;
            font-size: 28px;
            color: #94a3b8;
        }

        .export-card {
            background: #0f172a;
            border: 1px solid var(--trl-border);
            border-radius: 16px;
            padding: 20px;
            height: 100%;
        }

        .stats-icon {
            width: 46px;
            height: 46px;
            border-radius: 12px;
            display: grid;
            place-items: center;
            font-size: 22px;
        }

        .stats-icon.blue {
            background: rgba(59, 130, 246, 0.2);
            color: #93c5fd;
        }

        .stats-icon.green {
            background: rgba(34, 197, 94, 0.2);
            color: #86efac;
        }

        .stats-icon.orange {
            background: rgba(245, 158, 11, 0.2);
            color: #fcd34d;
        }

        .stats-icon.gray {
            background: rgba(148, 163, 184, 0.2);
            color: #cbd5f5;
        }

        .soft-panel {
            background: #0e1524;
            border-radius: 16px;
            border: 1px solid var(--trl-border);
        }

        .status-row {
            background: #101a2a;
            border-radius: 14px;
            padding: 14px 18px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 14px;
        }

        .status-row:last-child {
            margin-bottom: 0;
        }

        .status-row .label {
            display: flex;
            align-items: center;
            gap: 12px;
            font-weight: 500;
        }

        .status-row .value {
            font-size: 20px;
            font-weight: 600;
        }

        @media (max-width: 992px) {
            .sidebar {
                display: none;
            }

            .search-input-group {
                width: 100%;
            }

            .topbar {
                flex-direction: column;
                align-items: flex-start;
                gap: 16px;
            }
        }
    </style>
</head>
<body>
<div class="app-shell">
    <aside class="sidebar">
        <div class="sidebar-brand">
            <div class="icon">
                <i class="bi bi-wrench"></i>
            </div>
            <div>
                <div class="fw-semibold">TRL</div>
                <small>Tools Lifecycle Hub</small>
            </div>
        </div>

        <nav class="nav-section">
            <a class="nav-link {{ request()->is('dashboard') ? 'active' : '' }}" href="/dashboard"><i class="bi bi-grid"></i>Dashboard</a>
            <a class="nav-link {{ request()->is('scan') ? 'active' : '' }}" href="/scan"><i class="bi bi-qr-code-scan"></i>Scan QR/Barcode</a>
            <a class="nav-link {{ request()->is('tools*') ? 'active' : '' }}" href="/tools"><i class="bi bi-hammer"></i>Master Alat</a>
            <a class="nav-link {{ request()->is('borrow*') ? 'active' : '' }}" href="/borrow"><i class="bi bi-arrow-left-right"></i>Peminjaman</a>
            <a class="nav-link {{ request()->is('damage*') ? 'active' : '' }}" href="/damage"><i class="bi bi-exclamation-triangle"></i>Kerusakan</a>
            <a class="nav-link {{ request()->is('repairs*') ? 'active' : '' }}" href="/repairs"><i class="bi bi-gear"></i>Perbaikan</a>
            <a class="nav-link {{ request()->is('reports*') ? 'active' : '' }}" href="/reports"><i class="bi bi-file-earmark-text"></i>Laporan</a>
        </nav>

        <div class="sidebar-user">
            <div class="d-flex align-items-center gap-3 mb-3">
                <div class="avatar">{{ strtoupper(substr(auth()->user()->name ?? 'A', 0, 1)) }}</div>
                <div>
                    <div class="fw-semibold">{{ auth()->user()->email ?? 'admin@trl.localt' }}</div>
                    <small class="text-uppercase text-muted">Requester</small>
                </div>
            </div>
            <form action="/logout" method="post">
                @csrf
                <button class="btn btn-outline-light btn-sm w-100" type="submit">
                    <i class="bi bi-box-arrow-right me-2"></i>Keluar
                </button>
            </form>
        </div>
    </aside>

    <div class="main-panel">
        <header class="topbar">
            <div class="topbar-title">
                @hasSection('topbar-title')
                    @yield('topbar-title')
                @else
                    <h5>Selamat datang, {{ auth()->user()->email ?? 'admin@trl.localt' }}</h5>
                    <span>Dashboard TRL</span>
                @endif
            </div>
            <div class="topbar-actions">
                <div class="search-input-group">
                    <i class="bi bi-search text-muted"></i>
                    <input class="search-input" type="text" placeholder="Cari..." aria-label="Cari">
                </div>
                <div class="notification">
                    <i class="bi bi-bell"></i>
                    <span class="badge rounded-pill">3</span>
                </div>
            </div>
        </header>

        <main class="content-wrapper">
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
    </div>
</div>
</body>
</html>
