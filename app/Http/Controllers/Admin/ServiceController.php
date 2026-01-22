<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Welcomeguest\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $services = Service::withCount('programs')->paginate(15);

        return view('admin.tools.services.index', compact('services'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.tools.services.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:10|unique:services,code',
            'description' => 'nullable|string',
            'class_mode' => 'required|in:online,offline,both',
            'education_levels' => 'nullable|array',
            'education_levels.*' => 'string',
            'for_parent_register' => 'boolean',
            'for_self_register' => 'boolean',
            'min_age' => 'nullable|integer|min:0',
            'max_age' => 'nullable|integer|min:0',
            'features' => 'nullable|string',
            'is_active' => 'boolean',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        Service::create([
            'name' => $request->name,
            'code' => strtoupper($request->code),
            'description' => $request->description,
            'class_mode' => $request->class_mode,
            'education_levels' => $request->education_levels ?? [],
            'for_parent_register' => $request->has('for_parent_register'),
            'for_self_register' => $request->has('for_self_register'),
            'min_age' => $request->min_age,
            'max_age' => $request->max_age,
            'features' => $request->features,
            'is_active' => $request->has('is_active'),
        ]);

        return redirect()->route('admin.services.index')
            ->with('success', 'Service created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Service $service)
    {
        $service->load(['programs' => function($query) {
            $query->withCount('registrations');
        }]);

        return view('admin.tools.services.show', compact('service'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Service $service)
    {
        return view('admin.tools.services.edit', compact('service'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Service $service)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:10|unique:services,code,' . $service->id,
            'description' => 'nullable|string',
            'class_mode' => 'required|in:online,offline,both',
            'education_levels' => 'nullable|array',
            'education_levels.*' => 'string',
            'for_parent_register' => 'boolean',
            'for_self_register' => 'boolean',
            'min_age' => 'nullable|integer|min:0',
            'max_age' => 'nullable|integer|min:0',
            'features' => 'nullable|string',
            'is_active' => 'boolean',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $service->update([
            'name' => $request->name,
            'code' => strtoupper($request->code),
            'description' => $request->description,
            'class_mode' => $request->class_mode,
            'education_levels' => $request->education_levels ?? [],
            'for_parent_register' => $request->has('for_parent_register'),
            'for_self_register' => $request->has('for_self_register'),
            'min_age' => $request->min_age,
            'max_age' => $request->max_age,
            'features' => $request->features,
            'is_active' => $request->has('is_active'),
        ]);

        return redirect()->route('admin.services.index')
            ->with('success', 'Service updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Service $service)
    {
        // Check if service has programs
        if ($service->programs()->count() > 0) {
            return redirect()->back()
                ->with('error', 'Cannot delete service with existing programs.');
        }

        $service->delete();

        return redirect()->route('admin.services.index')
            ->with('success', 'Service deleted successfully.');
    }

    /**
     * Toggle service active status
     */
    public function toggle(Service $service)
    {
        $service->update(['is_active' => !$service->is_active]);

        return redirect()->back()
            ->with('success', 'Service status updated successfully.');
    }
}
