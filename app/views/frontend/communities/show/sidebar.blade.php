<div class="sidebar-inner">
    <div class="page-title-container clearfix">
        <h1 class="page-title">
          @if (isset($page))
            {{ '<span>' . $community->name . '</span><br />' . ucwords(str_replace('_', ' ', $page->name)) }}
          @else
              @if ($content != 'about')
                {{ '<span>' . $community->name . '</span><br />' . ucwords(str_replace('_', ' ', $content)) }}
              @else
                {{ '<span>' . $community->name . '</span>' }}
              @endif
          @endif
        </h1>
    </div>

      <div class="hidden">
        @foreach ($community->images as $key => $image)
            <a href="{{ $image->path }}" class="gallery-image-hidden" title="{{ $image->name }}">
              <img src="{{ $image->path }}" alt="{{ $image->name }}" />
            </a>
        @endforeach
      </div>

    <ul class="navigation list-unstyled">
        <li><h5>Information</h5></li>
        <li>
            <a @if ($content == 'about') class="active" @endif href="{{ url('communities/' . $community->slug . '.html') }}">
                <span class="fa fa-question-circle sidebar-icon"></span>
                About
            </a>
        </li>
        <li>
            @if ($community->main_image)
                <a href="{{ $community->main_image }}" class="gallery-image-hidden">
            @else
                <a href="{{ $community->images->first()->path }}" class="gallery-image-hidden">
            @endif
                <span class="fa fa-photo sidebar-icon"></span>
                Gallery
            </a>
        </li>
        <li>
            <a @if ($content == 'map') class="active" @endif href="{{ url('communities/' . $community->slug . '/map.html') }}">
                <span class="fa fa-map-marker sidebar-icon"></span>
                Map
            </a>
        </li>
        <li>
            <a @if ($content == 'apply') class="active" @endif href="{{ url('communities/' . $community->slug . '/apply.html') }}">
                <span class="fa fa-file sidebar-icon"></span>
                Apply
            </a>
        </li>
        <li>
            <a @if ($content == 'contact') class="active" @endif href="{{ url('communities/' . $community->slug . '/contact.html') }}">
                <span class="fa fa-envelope sidebar-icon"></span>
                Contact Us
            </a>
        </li>
        @if ($community->communityEvents)
           <li>
                <a @if ($content == 'events') class="active" @endif href="{{ url('communities/' . $community->slug . '/events.html') }}">
                    <span class="fa fa-calendar sidebar-icon"></span>
                    Events
                </a>
            </li>
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
        <div class="push-bottom">
            <a href="{{ $community->newsletter }}" target="_blank" class="btn btn-default btn-block">
                <span class="fa fa-file-pdf-o button-icon-nudge-right"></span>
                View Newsletter
            </a>
            @if (count($newsletters))
                <a href="{{ url('communities/' . $community->slug . '/newsletters.html') }}" class="small text-center btn-block text-primary">View Previous Newsletters</a>
            @endif
        </div>
    @endif
    <a target="_blank" class="btn btn-primary btn-block push-bottom" href="{{ url('https://www.paylease.com/index_out.php?pm_id=4849579') }}">
        <span class="fa fa-credit-card button-icon-nudge-right"></span>
        Pay Online
    </a>
    @if ($community->license_number)
        <p class="text-center small">{{ $community->license_number }}</p>
    @endif
</div>