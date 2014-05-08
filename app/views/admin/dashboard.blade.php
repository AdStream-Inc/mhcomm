@extends('admin.template.base')

@section('content')
  <h1>Dashboard</h1>
  <hr />
  <div class="panel panel-primary">
    <div class="panel-heading">
      <h3 class="panel-title">Recent Communities &nbsp;&nbsp;<small>Communities total: {{ $communitiesCount }}</small></h3>
    </div>
    @if (count($recentCommunities))
      <table class="table table-striped table-hover">
        <thead>
          <tr>
            <th class="col-md-6">Name</th>
            <th class="col-md-3">Email</th>
            <th class="col-md-3">Created On</th>
          </tr>
        </thead>
        <tbody>
          @foreach($recentCommunities as $community)
            <tr>
              <td>{{ $community->name }}</td>
              <td>{{ $community->email }}</td>
              <td>{{ $community->present()->createdOn }}</td>
            </tr>
          @endforeach
        </tbody>
      </table>
    @else
      <div class="panel-body">
        <p>No communities found.</p>
        <a href="{{ route($adminUrl . '.communities.index') }}" class="btn btn-sm btn-success">Create a Community</a>
      </div>
    @endif
  </div>
  <div class="row">
    <div class="col-md-6">
      <div class="panel panel-primary">
        <div class="panel-heading">
          <h3 class="panel-title">Recent Pages &nbsp;&nbsp;<small>Pages total: {{ $pagesCount }}</small></h3>
        </div>
        @if (count($recentPages))
          <table class="table table-striped table-hover">
            <thead>
              <tr>
                <th class="col-md-5">Name</th>
                <th class="col-md-3">Enabled</th>
                <th class="col-md-4">Created On</th>
              </tr>
            </thead>
            <tbody>
              @foreach($recentPages as $page)
                <tr>
                  <td>{{ $page->name }}</td>
                  <td>{{ $page->present()->isEnabled }}</td>
                  <td>{{ $page->present()->createdOn }}</td>
                </tr>
              @endforeach
            </tbody>
          </table>
        @else
          <div class="panel-body">
            <p>No pages found.</p>
            <a href="{{ route($adminUrl . '.pages.index') }}" class="btn btn-sm btn-success">Create a Page</a>
          </div>
        @endif
      </div>
      <div class="panel panel-primary">
        <div class="panel-heading">
          <h3 class="panel-title">Recent Jobs &nbsp;&nbsp;<small>Jobs total: {{ $jobsCount }}</small></h3>
        </div>
        @if (count($recentJobs))
          <table class="table table-striped table-hover">
            <thead>
              <tr>
                <th class="col-md-5">Name</th>
                <th class="col-md-3">Available</th>
                <th class="col-md-4">Created On</th>
              </tr>
            </thead>
            <tbody>
              @foreach($recentJobs as $job)
                <tr>
                  <td>{{ $job->name }}</td>
                  <td>{{ $job->present()->available }}</td>
                  <td>{{ $job->present()->createdOn }}</td>
                </tr>
              @endforeach
            </tbody>
          </table>
        @else
          <div class="panel-body">
            <p>No jobs found.</p>
            <a href="{{ route($adminUrl . '.jobs.create') }}" class="btn btn-sm btn-success">Create a Job</a>
          </div>
        @endif
      </div>
    </div>
    <div class="col-md-6">
      <div class="panel panel-primary">
        <div class="panel-heading">
          <h3 class="panel-title">Recent Users &nbsp;&nbsp;<small>Users total: {{ $usersCount }}</small></h3>
        </div>
        @if (count($recentUsers))
          <table class="table table-striped table-hover">
            <thead>
              <tr>
                <th class="col-md-5">Name</th>
                <th class="col-md-3">Group</th>
                <th class="col-md-4">Created On</th>
              </tr>
            </thead>
            <tbody>
              @foreach($recentUsers as $person)
                <tr>
                  <td>{{ $person->present()->fullName }}</td>
                  <td>{{ $person->present()->group }}</td>
                  <td>{{ $person->present()->createdOn }}</td>
                </tr>
              @endforeach
            </tbody>
          </table>
        @else
          <div class="panel-body">
            <p>No users found.</p>
            <a href="{{ route($adminUrl . '.users.create') }}" class="btn btn-sm btn-success">Create a User</a>
          </div>
        @endif
      </div>
      <div class="panel panel-primary">
        <div class="panel-heading">
          <h3 class="panel-title">Recent Specials &nbsp;&nbsp;<small>Specials total: {{ $specialsCount }}</small></h3>
        </div>
        @if (count($recentSpecials))
          <table class="table table-striped table-hover">
            <thead>
              <tr>
                <th class="col-md-5">Name</th>
                <th class="col-md-3">Enabled?</th>
                <th class="col-md-4">Created On</th>
              </tr>
            </thead>
            <tbody>
              @foreach($recentSpecials as $special)
                <tr>
                  <td>{{ $special->name }}</td>
                  <td>{{ $special->present()->isEnabled }}</td>
                  <td>{{ $special->present()->createdOn }}</td>
                </tr>
              @endforeach
            </tbody>
          </table>
        @else
          <div class="panel-body">
            <p>No specials found.</p>
            <a href="{{ route($adminUrl . '.specials.create') }}" class="btn btn-sm btn-success">Create a Special</a>
          </div>
        @endif
      </div>
    </div>
  </div>
@stop