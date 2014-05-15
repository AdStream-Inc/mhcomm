@include('frontend.communities.show.gallery')
<div class="well">
	<p class="lead">{{ strip_tags($community->description) }}</p>
    
    <div class="amenities about-section">
        <h2>Amenities</h2>
        {{ nl2br($community->amenities) }}
    </div>
    
    <div class="benefits about-section">
        <h2>Benefits</h2>
        {{ nl2br($community->benefits) }}
    </div>
    
    <div class="points-of-interest about-section">
        <h2>Points of Interest</h2>
        {{ nl2br($community->points_of_interest) }}
    </div>
</div>