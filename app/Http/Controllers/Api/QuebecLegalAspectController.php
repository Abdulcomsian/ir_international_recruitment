<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\QuebecLegalAspectResource;
use App\Models\QuebecLegalAspect;

class QuebecLegalAspectController extends Controller
{

    public function index()
    {

        $quebecLegalAspect = QuebecLegalAspect::all();

        return QuebecLegalAspectResource::collection($quebecLegalAspect);

    }

}
