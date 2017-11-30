<!DOCTYPE html>
<html>
<head>
    <title>
        @yield('title', 'Expense Logger')
    </title>

    <meta charset="UTF-8">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js"></script>
    @stack('head')

</head>
<body>
    
    <div class="container">
        <div class="page-header text-center">
            <h1>Personal Expense Logger</h1> 
            <p>Track and log your expense, Watch your budget!</p> 
        </div>
        @include('module.nav')
        @yield('content')
    </div>

    @stack('body')
    
</body>
</html>