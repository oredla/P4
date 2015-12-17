<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Badcow\LoremIpsum;

class UsersController extends Controller {

    public function __construct() {
        # Put anything here that should happen before any of the other actions
    }

    /**
     * Responds to requests to GET /user
     */
    public function getUser() {
        return view('users.profile');
    }
    /**
     * Responds to requests to POST /lorem-ipsum's generator page
     */
    public function postLoremGenerator(Request $request) {
        // Validate the request data: loreminput
        $this->validate($request,
          ['loreminput' => 'required|integer|min:1|max:99']
        );
        $generator = new LoremIpsum\Generator();
        $paragraphs = $generator->getParagraphs($request['loreminput']);
        //this way of implode will ensure the beginning of the paragraph will have a proper <p> tag
        //the example on http://p3.dwa15.com/lorem-ipsum does not generate the first <p> tag
         $output = '<p>' . implode('</p><p>', $paragraphs ) . '</p>';
        return view('loremipsum.lorem')->with('output', $output);
    }
  }
