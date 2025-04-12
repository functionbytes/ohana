<?php

namespace App\Http\Controllers\Managers\Distributors;

use App\Models\Delegation\Delegation;
use App\Http\Controllers\Controller;
use App\Models\Course\Course;
use Illuminate\Http\Request;

class CourseController extends Controller
{

    public function index($uid){

        $distributor = Delegation::uid($uid);

        $course = $distributor->courses;

        $courses = Course::available()->get();
        $courses = $courses->pluck('title', 'id');

        return view('managers.views.distributors.courses.index')->with([
            'distributor' => $distributor,
            'courses' => $courses,
            'course' => $course,
        ]);

    }

    public function update(Request $request){

        $distributor = Delegation::uid($request->uid);

        if (!$distributor) {
            return response()->json([
                'success' => false,
                'message' => 'Distribuidor no encontrado.',
            ], 404);
        }

        $currentCourses = $distributor->courses->pluck('id')->toArray();

        $newCourses = $request->courses ? explode(',', $request->courses) : [];

        if (!empty($newCourses)) {

            $toDetach = array_diff($currentCourses, $newCourses);
            $distributor->courses()->detach($toDetach);

            foreach ($newCourses as $id) {
                if (!in_array($id, $currentCourses)) {
                    $distributor->courses()->attach($id);
                }
            }

            $response = [
                'success' => true,
                'message' => 'Cursos actualizados correctamente.',
                'detached_courses' => $toDetach,
                'attached_courses' => array_diff($newCourses, $currentCourses),
            ];

            return response()->json($response);
        }

        return response()->json([
            'success' => false,
            'message' => 'No se proporcionaron cursos para actualizar.',
        ]);


    }



}
