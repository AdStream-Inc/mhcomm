<?php namespace Adstream\Controllers;

use Response;
use Input;
use Str;

class WysiwygController extends \Controller {

  public function postIndex() {
    $destination = '/wysiwyg-uploads/';
    $file = Input::file('file');
    $extension = '.png';
    $name = Str::random() . '-' . date('Y-m-d') . $extension;
    $file->move(public_path() . $destination, $name);

    return Response::json(array('link' => url('/') . $destination . $name));
  }

}