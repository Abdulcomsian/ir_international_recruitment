<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\StayAnonymous;
use Illuminate\Support\Facades\Log;
use App\Http\Requests\Api\StayAnonymous\{StoreRequest};
use Illuminate\Http\Request;

class StayAnonymousController extends Controller
{
    public function store(StoreRequest $request)
    {
        // dd($request->all());
        try {

            $imageName = null;
            $fileName = null;
            //handle img
            if ($request->hasFile('img')) {

                $image = $request->file('img');
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $imagePath = public_path('assets/StayAnonymous');
                $image->move($imagePath, $imageName);
            }

            //handle voice msg
            if ($request->hasFile('voice_msg')) {

                $file = $request->file('voice_msg');
                $fileName = time() . '.' . $file->getClientOriginalExtension();
                $filePath = public_path('assets/StayAnonymous');
                $file->move($filePath, $fileName);
            }

            // Fetch the latest complaint number or start from 1000
            $lastComplaint = StayAnonymous::latest('complain_no')->first();
            $newComplainNo = $lastComplaint ? $lastComplaint->complain_no + 1 : 1000;

            StayAnonymous::create([
                'complain_no' => $newComplainNo,
                'img_proof' => $imageName,
                'voice_msg' => $fileName,
                'address' => $request->address,
                'description' => $request->description
            ]);

            return response()->json([
                'status' => true,
                'msg' => 'Complaint received successfully',
            ], 200);

        } catch (\Exception $e) {
            Log::error('Failed to store Stay Anonymous complain: ' . $e->getMessage());
            return response()->json([
                'message' => 'Failed to store Stay Anonymous complain.',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
