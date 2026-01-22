<?php

namespace App\Http\Controllers\SIMY;

use App\Http\Controllers\Controller;
use App\Models\SIMY\Material;
use Illuminate\Support\Facades\Auth;

class MaterialController extends Controller
{
    /**
     * Display list of materials for student's programs
     */
    public function index()
    {
        $student = Auth::user();
        $programs = $student->programs()->whereNull('deleted_at')->pluck('id');
        
        $materials = Material::whereIn('program_id', $programs)
            ->where('is_published', true)
            ->with('program', 'notes', 'quizzes')
            ->latest('created_at')
            ->paginate(12);
        
        // Get filter options
        $filterPrograms = $student->programs()->whereNull('deleted_at')->get();
        $types = Material::whereIn('program_id', $programs)
            ->distinct()
            ->pluck('type');

        return view('simy.materials.index', compact('materials', 'filterPrograms', 'types'));
    }

    /**
     * Display a specific material
     */
    public function show(Material $material)
    {
        $student = Auth::user();
        
        // Check if student has access to this material
        if (!$student->programs()->where('program_id', $material->program_id)->exists()) {
            abort(403, 'Unauthorized');
        }

        $material->load('program', 'quizzes', 'assessments');
        
        // Get student's notes for this material
        $notes = $material->notes()->where('student_id', $student->id)->get();
        
        // Get related materials
        $relatedMaterials = Material::where('program_id', $material->program_id)
            ->where('id', '!=', $material->id)
            ->where('is_published', true)
            ->limit(5)
            ->get();

        return view('simy.materials.show', compact('material', 'notes', 'relatedMaterials'));
    }
}
