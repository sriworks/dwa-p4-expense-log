@php
    # Define a PHP array of links and their labels
    # This amount of PHP code in a view is okay because it's
    # display specific. By putting it in the view, I'm not making it
    # necessary to look in a logic file in order to edit link labels
    $nav = [
        'expense' => 'Expenses',
        'budget' => 'Manage Budget',
        'taxonomy' => 'Manage Categories & Tags'
    ];
@endphp

<nav class="navbar navbar-default navbar-static-top">
    <div class="container-fluid">

        <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
                @foreach($nav as $link => $label)
                    <li><a href='/{{ $link }}' class='{{ Request::is($link) ? 'active' : '' }}'>{{ $label }}</a>
                @endforeach
            </ul>
        </div><!--/.nav-collapse -->
    </div><!--/.container-fluid -->
</nav>