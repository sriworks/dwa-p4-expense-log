<ul class="list-group">
      <li class="list-group-item list-group-item-primary">Categories</li>
        @foreach($categories as $category)
            <li class="list-group-item list-group-item-light">{{ $category['term'] }}</li>
        @endforeach
</ul>