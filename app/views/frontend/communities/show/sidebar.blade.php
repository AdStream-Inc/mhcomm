<ul class="navigation list-unstyled">
    <li>{{ link_to('communities/' . $community->slug . '.html', 'About', array('class' => $content == 'about' ? 'active' : '')) }}</li>
    <li>{{ link_to('communities/' . $community->slug . '/specials.html', 'Specials', array('class' => $content == 'specials' ? 'active' : '')) }}</li>
    <li>{{ link_to('communities/' . $community->slug . '/map.html', 'Map', array('class' => $content == 'map' ? 'active' : '')) }}</li>
    <li>{{ link_to('communities/' . $community->slug . '/contact.html', 'Contact', array('class' => $content == 'contact' ? 'active' : '')) }}</li>
</ul>
<div class="well office-hours">
    <h5>Office Hours</h5>
    {{ nl2br($community->office_hours) }}
</div>