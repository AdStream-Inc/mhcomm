<div class="well specials-list">
	<ul class="list-unstyled">
        @foreach ($community->specials as $special)
            <li>
            	<h3>{{ $special->name }}</h3>
              <p>{{ strip_tags($special->content) }}</p>
            </li>
        @endforeach
    </ul>
</div>