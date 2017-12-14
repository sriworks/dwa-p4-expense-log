@php
    # Define a PHP array of links and their labels
    # This amount of PHP code in a view is okay because it's
    # display specific. By putting it in the view, I'm not making it
    # necessary to look in a logic file in order to edit link labels
    $nav = [
        '' => 'Home',
        'expense' => 'Expenses',
        'budget' => 'Manage Budget',
        'taxonomy' => 'Settings'
    ];
@endphp

<nav class="navbar justify-content-center navbar-expand-lg navbar-light bg-warning">
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
    <div class="navbar-nav">
        @foreach($nav as $link => $label)
                <a href='/{{ $link }}' class='nav-item nav-link {{ Request::is(($link == ''?'/':$link)) ? 'active' : '' }}'>{{ $label }}</a>
        @endforeach
    </div>
  </div>
    <a class="btn my-2 my-sm-0 btn-primary" href="/expense/create">Log Expense</a>
</nav>
