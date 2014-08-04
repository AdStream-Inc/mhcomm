<?php namespace Adstream\Controllers\Admin;

use View;
use Input;
use DB;
use Response;
use Excel;
use Alert;
use Redirect;
use Adstream\Controllers\BaseController;

class ApplicationsController extends BaseController {
  public function index()
  {
    $applicants = DB::table('applicants')->get();

    return View::make('admin.applications.index', compact('applicants'));
  }

  public function store()
  {
    $startDate = Input::get('start_date');
    $endDate = Input::get('end_date');

    $applications = DB::table('applicants')
      ->select('first_name', 'last_name', 'email', 'phone', 'community', 'created_at')
      ->where('created_at', '>=', date('Y-m-d H:i:s', strtotime($startDate)))
      ->where('created_at', '<=', date('Y-m-d H:i:s', strtotime($endDate)))
      ->get();

    // this is super hacky...
    // converts a object to an assoc array since
    // Laravel's query builder does not have
    // a native toArray method built in
    $applications = json_encode($applications);
    $applications = json_decode($applications, true);

    if ($applications) {
      $excel = Excel::create('applicants-' . date('Y-m-d-H-m-s'), function($excel) use($applications) {
        $excel->sheet('Applicants', function($sheet) use($applications) {
          $sheet->fromArray($applications);
        });
      })->store('csv', false, true);

      return Response::download($excel['full']);
    }

    Alert::error('There are no applications found for this date range.')->flash();
    return Redirect::to($this->adminUrl . '/applications')->withInput();
  }
}