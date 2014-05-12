@extends('frontend.template.base.base')

@section('main')

	<div class="container">

        <section role="content" class="col-xs-12 col-sm-9">
            @yield('content')
        </section>
        
        <aside role="sidebar" class="col-xs-12 col-sm-3">
            @yield('sidebar')
        </aside>

	</div>
	
@stop