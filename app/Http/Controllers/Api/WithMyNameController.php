<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\WithMyName;
use Illuminate\Support\Facades\Log;
use App\Http\Requests\Api\WithMyName\{StoreRequest};
use Illuminate\Http\Request;

class WithMyNameController extends Controller
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
                $imagePath = public_path('assets/WithMyName');
                $image->move($imagePath, $imageName);
            }

            //handle voice msg
            if ($request->hasFile('voice_msg')) {

                $file = $request->file('voice_msg');
                $fileName = time() . '.' . $file->getClientOriginalExtension();
                $filePath = public_path('assets/WithMyName');
                $file->move($filePath, $fileName);
            }

            // Fetch the latest complaint number or start from 1000
            $lastComplaint = WithMyName::latest('complain_no')->first();
            $newComplainNo = $lastComplaint ? $lastComplaint->complain_no + 1 : 1000;

            WithMyName::create([
                'complain_no' => $newComplainNo,
                'name' => $request->name,
                'country_code' => $request->country_code,
                'phone_no' => $request->phone_no,
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
            Log::error('Failed to store With My Name complain: ' . $e->getMessage());
            return response()->json([
                'message' => 'Failed to store With My Name complain.',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
