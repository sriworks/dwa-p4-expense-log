<ul class="list-group">
      <li class="list-group-item list-group-item-info">Tags</li>
        @foreach($tags as $tag)
            <li class="list-group-item list-group-item-light">{{ $tag['term'] }}</li>
        @endforeach
</ul>