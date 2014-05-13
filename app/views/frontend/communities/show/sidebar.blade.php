<div class="well">
    <ul class="navigation list-unstyled">
        <li>{{ link_to('communities/' . $community->slug . '.html', 'About') }}</li>
        <li>{{ link_to('communities/' . $community->slug . '/specials.html', 'Specials') }}</li>
        <li>{{ link_to('communities/' . $community->slug . '/map.html', 'Map') }}</li>
        <li>{{ link_to('communities/' . $community->slug . '/contact.html', 'Contact') }}</li>
    </ul>
    <div class="office-hours">
        <h5>Office Hours</h5>
        {{ nl2br($community->office_hours) }}
    </div>
</div>