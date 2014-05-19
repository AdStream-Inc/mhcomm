<div class="container">
  @yield('breadcrumbs')
	<div class="row">
    <section role="content" class="col-xs-12 col-sm-9 col-sm-push-3">
        @yield('content')
    </section>
    <aside role="sidebar" class="col-xs-12 col-sm-3 col-sm-pull-9">
        @yield('sidebar')
    </aside>
	</div>
</div>