<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\{QuebecLegalAspectResource, QuebecLegalAspectNavigationResource, QuebecLegalAspectFaqResource, QuebecLegalAspectUsefulLinkResource};
use App\Models\{QuebecLegalAspect, QuebecLegalAspectFaq, QuebecLegalAspectNavigation, QuebecLegalAspectUsefulLink};
use Illuminate\Support\Facades\Log;

class QuebecLegalAspectController extends Controller
{

    public function index()
    {
        try {
            $quebecLegalAspect = QuebecLegalAspect::all();
            return QuebecLegalAspectResource::collection($quebecLegalAspect);
        } catch (\Throwable $th) {
            Log::error('Failed to retrieve legal aspects: ' . $th->getMessage());
            return response()->json([
                'message' => 'Failed to retrieve legal aspects data.',
                'error' => $th->getMessage()
            ], 500);
        }
    }

    public function navigations()
    {
        try {
            $quebecLegalAspectNavigations = QuebecLegalAspectNavigation::with('quebecLegalAspect')->get();
            return QuebecLegalAspectNavigationResource::collection($quebecLegalAspectNavigations);
        } catch (\Throwable $th) {
            Log::error('Failed to retrieve navigation data: ' . $th->getMessage());
            return response()->json([
                'message' => 'Failed to retrieve navigation data.',
                'error' => $th->getMessage()
            ], 500);
        }
    }

    public function faqs()
    {
        try {
            $quebecLegalAspectFaqs = QuebecLegalAspectFaq::with('quebecLegalAspect')->get();
            return QuebecLegalAspectFaqResource::collection($quebecLegalAspectFaqs);
        } catch (\Throwable $th) {
            Log::error('Failed to retrieve FAQ data: ' . $th->getMessage());
            return response()->json([
                'message' => 'Failed to retrieve FAQ data.',
                'error' => $th->getMessage()
            ], 500);
        }
    }


    public function usefulLinks()
    {

        try {

            $quebecLegalAspectUsefulLinks = QuebecLegalAspectUsefulLink::with('quebecLegalAspect')->get();

            return QuebecLegalAspectUsefulLinkResource::collection($quebecLegalAspectUsefulLinks);
        } catch (\Throwable $th) {
            // Log the error for debugging if needed
            Log::error('Failed to retrieve useful links: ' . $th->getMessage());

            return response()->json([
                'message' => 'Failed to retrieve useful links data.',
                'error' => $th->getMessage()
            ], 500);
        }
    }
}
