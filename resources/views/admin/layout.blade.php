<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Admin Panel')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <style>
        body { background:#f5f7fb; }
        .sidebar { min-height:100vh; background:#063b24; }
        .sidebar a { color:rgba(255,255,255,.82); text-decoration:none; display:block; padding:12px 18px; border-radius:10px; margin-bottom:4px; }
        .sidebar a:hover, .sidebar a.active { background:#0b5d3b; color:#fff; }
        .content-card { background:#fff; border:1px solid #e9eef5; border-radius:14px; box-shadow:0 10px 28px rgba(15,23,42,.05); }
        label { font-weight:700; }
    </style>
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <aside class="col-lg-2 sidebar p-3">
                <h4 class="text-white mb-4">Admin Panel</h4>
                <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}"><i class="bi bi-speedometer2"></i> Dashboard</a>
                <a href="{{ route('admin.sections.index') }}" class="{{ request()->routeIs('admin.sections.*') ? 'active' : '' }}"><i class="bi bi-layout-text-window"></i> Sections</a>
                <a href="{{ route('admin.sliders.index') }}" class="{{ request()->routeIs('admin.sliders.*') ? 'active' : '' }}"><i class="bi bi-images"></i> Hero Slider</a>
                <a href="{{ route('admin.products.index') }}" class="{{ request()->routeIs('admin.products.*') ? 'active' : '' }}"><i class="bi bi-box-seam"></i> Products</a>
                <a href="{{ route('admin.testimonials.index') }}" class="{{ request()->routeIs('admin.testimonials.*') ? 'active' : '' }}"><i class="bi bi-chat-quote"></i> Testimonials</a>
                <a href="{{ route('admin.messages.index') }}" class="{{ request()->routeIs('admin.messages.*') ? 'active' : '' }}"><i class="bi bi-envelope"></i> Messages</a>
                <a href="{{ route('admin.settings.edit') }}" class="{{ request()->routeIs('admin.settings.*') ? 'active' : '' }}"><i class="bi bi-gear"></i> Settings</a>
                <a href="{{ route('home') }}" target="_blank"><i class="bi bi-globe"></i> View Website</a>
                <form method="post" action="{{ route('admin.logout') }}" class="mt-3">
                    @csrf
                    <button type="submit" class="btn btn-outline-light w-100"><i class="bi bi-box-arrow-right"></i> Log out</button>
                </form>
            </aside>
            <main class="col-lg-10 p-4">
                <div class="d-flex align-items-center justify-content-between mb-4">
                    <h1 class="h3 mb-0">@yield('title')</h1>
                    <span class="text-muted">{{ now()->format('M d, Y') }}</span>
                </div>
                @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif
                @if ($errors->any())
                    <div class="alert alert-danger">Please check the highlighted fields.</div>
                @endif
                @yield('content')
            </main>
        </div>
    </div>
</body>

</html>
