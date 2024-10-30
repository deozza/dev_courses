<?php

namespace App\Controllers;

use App\Http\Request;
use App\Http\Response;

abstract class AbstractController{
    abstract public function process(Request $request): Response;
}