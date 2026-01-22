<?php

namespace App\Http\Controllers\SIMY;

use App\Http\Controllers\Controller;
use App\Models\SIMY\StudentNote;
use App\Models\SIMY\Material;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NoteController extends Controller
{
    /**
     * Store a new student note
     */
    public function store(Request $request)
    {
        $student = Auth::user();
        
        $validated = $request->validate([
            'material_id' => 'required|exists:materials,id',
            'title' => 'nullable|string|max:255',
            'content' => 'required|string'
        ]);

        $material = Material::findOrFail($validated['material_id']);
        
        // Check if student has access to this material
        if (!$student->programs()->where('program_id', $material->program_id)->exists()) {
            abort(403, 'Unauthorized');
        }

        StudentNote::create([
            'student_id' => $student->id,
            'material_id' => $validated['material_id'],
            'program_id' => $material->program_id,
            'title' => $validated['title'] ?? 'Catatan - ' . now()->format('d M Y H:i'),
            'content' => $validated['content']
        ]);

        return back()->with('success', 'Catatan berhasil disimpan!');
    }

    /**
     * Delete a student note
     */
    public function destroy(StudentNote $note)
    {
        $student = Auth::user();
        
        // Check ownership
        if ($note->student_id !== $student->id) {
            abort(403, 'Unauthorized');
        }

        $note->delete();
        return back()->with('success', 'Catatan berhasil dihapus!');
    }
}
