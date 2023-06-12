<?php

namespace App\Http\Controllers;

use App\Http\Request;
use App\Http\Response;

class PromoCodeController extends Controller
{
    public function getUserCode(Request $request): Response
    {
        return $this->redirect('http://google.com');
    }
}
