@foreach ($pages as $page)
  @if ($page->enabled)
    <li>
      <a @if ($activePage == $page->id) class="active" @endif href="{{ url('communities/' . $slug . '/' . $page->slug . '.html') }}">
        @if ($page->icon)
          <span class="fa {{ $page->icon }} sidebar-icon"></span>
        @endif
        {{ $indent . $page->name }}
      </a>
    	@if ($children = $community->getPages($page->id))
        <ul>
        	@include('frontend.communities.show.sidebar.pages', array('community' => $community, 'pages' => $children, 'slug' => $slug . '/' . $page->slug, 'indent' => $indent . '&nbsp;&nbsp;'))
  		  </ul>
      @endif
    </li>
  @endif
@endforeach