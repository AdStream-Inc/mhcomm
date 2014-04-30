@extends('admin.template.base')

@section('content')
  <h1>Dashboard</h1>
  <hr />
  <div class="row">
    <div class="col-md-6">
      <div class="panel panel-primary">
        <div class="panel-heading">
          <h3 class="panel-title">Recent Pages <small>{{ $pagesCount }} Page(s) total</small></h3>
        </div>
        @if (count($recentPages))
          <table class="table table-striped table-hover">
            <thead>
              <tr>
                <th class="col-md-6">Name</th>
                <th class="col-md-3">Group</th>
                <th class="col-md-3">Created On</th>
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
            <a href="{{ route($adminUrl . '.pages.index') }}" class="btn btn-sm btn-success">Create A Page</a>
          </div>
        @endif
      </div>
      <div class="panel panel-primary">
        <div class="panel-heading">
          <h3 class="panel-title">Recent Jobs <small>{{ $jobsCount }} Jobs(s) total</small></h3>
        </div>
        @if (count($recentJobs))
          <table class="table table-striped table-hover">
            <thead>
              <tr>
                <th class="col-md-6">Name</th>
                <th class="col-md-3">Group</th>
                <th class="col-md-3">Created On</th>
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
            <a href="{{ route($adminUrl . '.jobs.create') }}" class="btn btn-sm btn-success">Create A Job</a>
          </div>
        @endif
      </div>
      <div class="panel panel-primary">
        <div class="panel-heading">
          <h3 class="panel-title">Recent Users <small>{{ $usersCount }} User(s) total</small></h3>
        </div>
        @if (count($recentUsers))
          <table class="table table-striped table-hover">
            <thead>
              <tr>
                <th class="col-md-6">Name</th>
                <th class="col-md-3">Group</th>
                <th class="col-md-3">Created On</th>
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
            <a href="{{ route($adminUrl . '.users.create') }}" class="btn btn-sm btn-success">Create A User</a>
          </div>
        @endif
      </div>
    </div>
    <div class="col-md-6">
      <p>Graphs will go here</p>
    </div>
  </div>
@stop