<ul class="navigation list-unstyled">
    <li>{{ link_to('communities/' . $community->slug . '.html', 'About', array('class' => $content == 'about' ? 'active' : '')) }}</li>
    @if ($community->specials->count())
    <li>{{ link_to('communities/' . $community->slug . '/specials.html', 'Specials', array('class' => $content == 'specials' ? 'active' : '')) }}</li>
    @endif
    <li>{{ link_to('communities/' . $community->slug . '/map.html', 'Map', array('class' => $content == 'map' ? 'active' : '')) }}</li>
    <li>{{ link_to('communities/' . $community->slug . '/contact.html', 'Contact', array('class' => $content == 'contact' ? 'active' : '')) }}</li>
     @if ($pages = $community->getPages(0))
	     @include('frontend.communities.show.sidebar.pages', array('community' => $community, 'pages' => $pages, 'slug' => $community->slug, 'indent' => '', 'activePage' => is_object($content) ? $content->id : ''))
     @endif
</ul>
<div class="well office-hours">
    <h5>Office Hours</h5>
    {{ nl2br($community->office_hours) }}
</div>