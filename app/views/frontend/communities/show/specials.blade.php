<div class="well specials-list">
	<ul class="list-unstyled flush-bottom">
        @foreach ($community->specials as $key => $special)
            <li class="flush-bottom">
            	<h3>{{ $special->name }}</h3>
              <p>{{ strip_tags($special->content) }}</p>
              @if ($key != (count($community->specials) - 1))
                <hr />
              @endif
            </li>
        @endforeach
    </ul>
</div>