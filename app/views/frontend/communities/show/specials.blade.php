<div class="panel panel-info">
  <div class="panel-heading">
    <h3 class="panel-title"><i class="fa fa-gift"></i> Current Special</h3>
  </div>
  <div class="panel-body">
    <div class="specials-list flush-bottom">
    	<ul class="list-unstyled flush-bottom">
            @foreach ($community->specials as $key => $special)
                <li class="flush-bottom">
                	<h3>{{ $special->name }}</h3>
                  <p>{{ $special->content }}</p>
                  @if ($key != (count($community->specials) - 1))
                    <hr />
                  @endif
                </li>
            @endforeach
        </ul>
    </div>
  </div>
</div>