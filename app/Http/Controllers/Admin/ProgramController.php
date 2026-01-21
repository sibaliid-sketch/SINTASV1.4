<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Program;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProgramController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Program::query();

        // Apply filters
        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }

        if ($request->filled('service_id')) {
            $query->where('service_id', $request->service_id);
        }

        if ($request->filled('education_level')) {
            $query->where('education_level', $request->education_level);
        }

        if ($request->filled('media')) {
            $query->where('media', $request->media);
        }

        if ($request->filled('is_active')) {
            $query->where('is_active', $request->is_active);
        }

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
            });
        }

        $programs = $query->paginate(15);
        $services = Service::active()->get();

        return view('admin.tools.programs.index', compact('programs', 'services'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $services = Service::active()->get();
        return view('admin.tools.programs.create', compact('services'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'type' => 'required|in:program,service',
            'service_id' => 'nullable|exists:services,id',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'education_level' => 'required|string|max:255',
            'media' => 'required|in:online,offline',
            'class_location' => 'required|string|max:255',
            'sessions_count' => 'required|integer|min:1',
            'hpp' => 'required|numeric|min:0',
            'price' => 'required|numeric|min:0',
            'unit' => 'required|string|max:255',
            'min_education_level' => 'nullable|string|max:255',
            'max_education_level' => 'nullable|string|max:255',
            'curriculum' => 'nullable|string',
            'max_students' => 'nullable|integer|min:1',
            'is_active' => 'boolean',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        Program::create([
            'type' => $request->type,
            'service_id' => $request->service_id,
            'name' => $request->name,
            'description' => $request->description,
            'education_level' => $request->education_level,
            'media' => $request->media,
            'class_location' => $request->class_location,
            'sessions_count' => $request->sessions_count,
            'hpp' => $request->hpp,
            'price' => $request->price,
            'unit' => $request->unit,
            'min_education_level' => $request->min_education_level,
            'max_education_level' => $request->max_education_level,
            'curriculum' => $request->curriculum,
            'max_students' => $request->max_students ?? 10,
            'is_active' => $request->has('is_active'),
        ]);

        return redirect()->route('admin.programs.index')
            ->with('success', 'Program created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Program $program)
    {
        $program->load(['service', 'schedules', 'registrations' => function($query) {
            $query->latest()->take(10);
        }]);

        return view('admin.tools.programs.show', compact('program'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Program $program)
    {
        $services = Service::active()->get();
        return view('admin.tools.programs.edit', compact('program', 'services'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Program $program)
    {
        $validator = Validator::make($request->all(), [
            'service_id' => 'nullable|exists:services,id',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'education_level' => 'required|string|max:255',
            'media' => 'required|in:online,offline',
            'class_location' => 'required|string|max:255',
            'sessions_count' => 'required|integer|min:1',
            'hpp' => 'required|numeric|min:0',
            'price' => 'required|numeric|min:0',
            'unit' => 'required|string|max:255',
            'min_education_level' => 'nullable|string|max:255',
            'max_education_level' => 'nullable|string|max:255',
            'curriculum' => 'nullable|string',
            'max_students' => 'nullable|integer|min:1',
            'is_active' => 'boolean',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $program->update([
            'service_id' => $request->service_id,
            'name' => $request->name,
            'description' => $request->description,
            'education_level' => $request->education_level,
            'media' => $request->media,
            'class_location' => $request->class_location,
            'sessions_count' => $request->sessions_count,
            'hpp' => $request->hpp,
            'price' => $request->price,
            'unit' => $request->unit,
            'min_education_level' => $request->min_education_level,
            'max_education_level' => $request->max_education_level,
            'curriculum' => $request->curriculum,
            'max_students' => $request->max_students ?? 10,
            'is_active' => $request->has('is_active'),
        ]);

        return redirect()->route('admin.programs.index')
            ->with('success', 'Program updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Program $program)
    {
        // Check if program has registrations
        if ($program->registrations()->count() > 0) {
            return redirect()->back()
                ->with('error', 'Cannot delete program with existing registrations.');
        }

        $program->delete();

        return redirect()->route('admin.programs.index')
            ->with('success', 'Program deleted successfully.');
    }

    /**
     * Toggle program active status
     */
    public function toggle(Program $program)
    {
        $program->update(['is_active' => !$program->is_active]);

        return redirect()->back()
            ->with('success', 'Program status updated successfully.');
    }

    /**
     * Get programs by service (AJAX)
     */
    public function getByService(Service $service)
    {
        $programs = $service->programs()->active()->get(['id', 'name', 'education_level']);

        return response()->json($programs);
    }
}
