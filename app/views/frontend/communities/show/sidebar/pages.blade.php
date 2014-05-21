@foreach ($pages as $page)
    <li>
    {{ link_to('communities/' . $slug . '/' . $page->slug . '.html', $indent . $page->name, array('class' => $activePage == $page->id ? 'active' : '')) }}
    	@if ($children = $community->getPages($page->id))
            <ul>
            	@include('frontend.communities.show.sidebar.pages', array('community' => $community, 'pages' => $children, 'slug' => $slug . '/' . $page->slug, 'indent' => $indent . '&nbsp;&nbsp;'))
			</ul>
        @endif
    </li>
@endforeach