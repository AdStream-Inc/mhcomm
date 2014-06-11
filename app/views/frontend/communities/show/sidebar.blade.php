<div class="sidebar-inner">
    <ul class="navigation list-unstyled">
        <li>{{ link_to('communities/' . $community->slug . '.html', 'About', array('class' => $content == 'about' ? 'active' : '')) }}</li>
        @if ($community->specials->count())
        <li>{{ link_to('communities/' . $community->slug . '/specials.html', 'Specials', array('class' => $content == 'specials' ? 'active' : '')) }}</li>
        @endif
        @if ($community->communityEvents->count())
            <li>{{ link_to('communities/' . $community->slug . '/events.html', 'Events', array('class' => $content == 'events' ? 'active' : '')) }}</li>
        @endif
        <li>{{ link_to('communities/' . $community->slug . '/map.html', 'Map', array('class' => $content == 'map' ? 'active' : '')) }}</li>
        <li>{{ link_to('communities/' . $community->slug . '/apply.html', 'Apply Now', array('class' => Request::is('communities/' . $community->slug . '/apply.html') ? 'active' : '')) }}</li>
        <li>{{ link_to('communities/' . $community->slug . '/contact.html', 'Contact', array('class' => $content == 'contact' ? 'active' : '')) }}</li>
         @if ($pages = $community->getPages(0))
    	     @include('frontend.communities.show.sidebar.pages', array('community' => $community, 'pages' => $pages, 'slug' => $community->slug, 'indent' => '', 'activePage' => is_object($content) ? $content->id : ''))
         @endif
    </ul>
    @if ($community->newsletter)
        <a href="{{ $community->newsletter }}" target="_blank" class="btn btn-default btn-block push-bottom">
            <span class="push-right fa fa-file-pdf-o"></span>
            View Newsletter
        </a>
    @endif
    <div class="well office-hours small">
        <h5>Office Hours</h5>
        {{ nl2br($community->office_hours) }}
    </div>
    @if ($community->license_number)
        <p class="text-center small">Housing License # {{ $community->license_number }}</p>
    @endif
    <a class="btn btn-primary btn-block push-bottom" href="{{ url('https://www.paylease.com/index_out.php?pm_id=4849579') }}">Pay Online</a>
</div>