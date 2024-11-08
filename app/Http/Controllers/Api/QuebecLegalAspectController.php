<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\{QuebecLegalAspectResource, QuebecLegalAspectNavigationResource, QuebecLegalAspectFaqResource};
use App\Models\{QuebecLegalAspect, QuebecLegalAspectFaq, QuebecLegalAspectNavigation};

class QuebecLegalAspectController extends Controller
{

    public function index()
    {

        $quebecLegalAspect = QuebecLegalAspect::all();

        return QuebecLegalAspectResource::collection($quebecLegalAspect);

    }

    public function navigations()
    {

        $quebecLegalAspectNavigations = QuebecLegalAspectNavigation::with('quebecLegalAspect')->get();

        return QuebecLegalAspectNavigationResource::collection($quebecLegalAspectNavigations);

    }

    public function faqs()
    {

        $quebecLegalAspectFaqs = QuebecLegalAspectFaq::with('quebecLegalAspect')->get();

        return QuebecLegalAspectFaqResource::collection($quebecLegalAspectFaqs);

    }

}
