@include('frontend.communities.show.gallery')
@if (count($community->specials))
    @include('frontend.communities.show.specials')
@endif
<div class="well">
	<p class="lead">{{ strip_tags($community->description) }}</p>
</div>
<div class="row">
    <div class="col-md-4">
        <div class="panel-group" id="accordion1">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <a data-toggle="collapse" data-parent="#accordion1" href="#amenities">
                            Amenities
                        </a>
                    </h4>
                </div>
                <div id="amenities" class="panel-collapse collapse in">
                    <div class="panel-body">
                        {{ nl2br($community->amenities) }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="panel-group" id="accordion2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <a data-toggle="collapse" data-parent="#accordion2" href="#benefits">
                            Benefits
                        </a>
                    </h4>
                </div>
                <div id="benefits" class="panel-collapse collapse in">
                    <div class="panel-body">
                        {{ nl2br($community->benefits) }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="panel-group" id="accordion3">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <a data-toggle="collapse" data-parent="#accordion3" href="#points-of-interest">
                            Points of Interest
                        </a>
                    </h4>
                </div>
                <div id="points-of-interest" class="panel-collapse collapse in">
                    <div class="panel-body">
                        {{ nl2br($community->points_of_interest) }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
