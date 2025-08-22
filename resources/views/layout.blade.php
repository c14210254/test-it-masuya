<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'My App')</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    @yield('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body>
    <div class="wrapper">
        <div class="sidebar">
            <h2>Test IT</h2>
            <ul>
                <li><a href="{{ route('customers.index') }}"><i class="fa-solid fa-users"></i> Customers</a></li>
                <li><a href="{{ route('transactions.index') }}"><i class="fa-solid fa-receipt"></i> Transactions</a></li>
                <li><a href="{{ route('products.index') }}"><i class="fa-solid fa-box"></i> Products</a></li>
            </ul>
        </div>
        <div class="main-content">
            @yield('content')
        </div>
    </div>
</body>
</html>
