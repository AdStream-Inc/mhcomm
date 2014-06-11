<div class="sidebar-inner">
    <ul class="navigation list-unstyled">
        <li><h5>Information</h5></li>
        <li>{{ link_to('communities/' . $community->slug . '.html', 'About', array('class' => $content == 'about' ? 'active' : '')) }}</li>
        @if ($community->specials->count())
        <li>{{ link_to('communities/' . $community->slug . '/specials.html', 'Specials', array('class' => $content == 'specials' ? 'active' : '')) }}</li>
        @endif
        <li>{{ link_to('communities/' . $community->slug . '/map.html', 'Map', array('class' => $content == 'map' ? 'active' : '')) }}</li>
        <li>{{ link_to('communities/' . $community->slug . '/apply.html', 'Apply Now', array('class' => Request::is('communities/' . $community->slug . '/apply.html') ? 'active' : '')) }}</li>
        <li>{{ link_to('communities/' . $community->slug . '/contact.html', 'Contact', array('class' => $content == 'contact' ? 'active' : '')) }}</li>
        @if ($community->communityEvents->count())
            <li>{{ link_to('communities/' . $community->slug . '/events.html', 'Events', array('class' => $content == 'events' ? 'active' : '')) }}</li>
        @endif
        @if ($pages = $community->getPages(0))
            <li class="push-top"><h5>Pages</h5></li>
    	     @include('frontend.communities.show.sidebar.pages', array('community' => $community, 'pages' => $pages, 'slug' => $community->slug, 'indent' => '', 'activePage' => is_object($content) ? $content->id : ''))
        @endif
    </ul>
    <h5>Resources</h5>
    <div class="well office-hours small">
        <h5>Office Hours</h5>
        {{ nl2br($community->office_hours) }}
    </div>
    @if ($community->newsletter)
        <a href="{{ $community->newsletter }}" target="_blank" class="btn btn-default btn-block push-bottom">
            <span class="fa fa-file-pdf-o button-icon-nudge-right"></span>
            View Newsletter
        </a>
    @endif
    <a class="btn btn-default btn-block push-bottom" href="{{ url('https://www.paylease.com/index_out.php?pm_id=4849579') }}">
        <span class="fa fa-credit-card button-icon-nudge-right"></span>
        Pay Online
    </a>
    @if ($community->license_number)
        <p class="text-center small">Housing License # {{ $community->license_number }}</p>
    @endif
</div>