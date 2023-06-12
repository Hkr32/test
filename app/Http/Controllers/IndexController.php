<?php

namespace App\Http\Controllers;

use App\Http\Request;
use App\Http\Response;

class IndexController extends Controller
{
    public function __invoke(Request $request): Response
    {
        return $this->render('index');
    }
}
