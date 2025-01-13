<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\EductionProgram;
use App\Models\EducationProgramsDetails;
use App\Models\Faculty;
use App\Models\Subheading;
class UniversityController extends Controller
{
    /**
     * Display a listing of the universities.
     */
    public function getAllUniversities()
    {
        $universities = EductionProgram::get();
        return response()->json([
            'status' => true,
            'msg' => 'Universities Fetched Successfully',
            'data' => $universities
        ], 200);
    }

    /**
     * details of all uni.
     */

    public function getUniversitiesDetails($id)
    {
        $universityDetails = EductionProgram::with('educationProgramDetail.getFaculty.subPrograms')
            ->where('id', $id)
            ->first();

        if (!$universityDetails) {
            return response()->json([
                'status' => false,
                'msg' => 'University not found',
                'data' => null
            ], 404);
        }

        $transformedData = $universityDetails->toArray(); 

        $transformedData['details'] = $transformedData['education_program_detail'];
        unset($transformedData['education_program_detail']);

        if (isset($transformedData['details']['get_faculty'])) {
            $transformedData['details']['faculties'] = $transformedData['details']['get_faculty'];
            unset($transformedData['details']['get_faculty']);
        } else {
            $transformedData['details']['faculties'] = null; 
        }

        if (isset($transformedData['details']['faculties'])) {
            foreach ($transformedData['details']['faculties'] as &$faculty) {
                if (isset($faculty['sub_programs'])) {
                    $faculty['subheading'] = $faculty['sub_programs'];
                    unset($faculty['sub_programs']);
                } else {
                    $faculty['subheading'] = null; 
                }
            }
        }

        return response()->json([
            'status' => true,
            'msg' => 'Universities Details Fetched Successfully',
            'data' => $transformedData
        ], 200);
    }


}
