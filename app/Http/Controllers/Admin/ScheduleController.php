<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\General\Schedule;
use App\Models\General\Program;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

class ScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Schedule::with('program.service');

        // Apply filters
        if ($request->filled('program_id')) {
            $query->where('program_id', $request->program_id);
        }

        if ($request->filled('day_of_week')) {
            $query->where('day_of_week', $request->day_of_week);
        }

        if ($request->filled('is_active')) {
            $query->where('is_active', $request->is_active);
        }

        if ($request->filled('search')) {
            $search = $request->search;
            $query->whereHas('program', function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%");
            });
        }

        $schedules = $query->paginate(15);
        $programs = Program::active()->with('service')->get();

        return view('admin.schedules.index', compact('schedules', 'programs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $programs = Program::active()->with('service')->get();
        return view('admin.schedules.create', compact('programs'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'program_id' => 'required|exists:programs,id',
            'day_of_week' => 'required|integer|between:1,7',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
            'max_students' => 'nullable|integer|min:1',
            'is_active' => 'boolean',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Check for schedule conflicts
        $conflict = Schedule::where('program_id', $request->program_id)
            ->where('day_of_week', $request->day_of_week)
            ->where(function($query) use ($request) {
                $query->where(function($q) use ($request) {
                    $q->where('start_time', '<=', $request->start_time)
                      ->where('end_time', '>', $request->start_time);
                })->orWhere(function($q) use ($request) {
                    $q->where('start_time', '<', $request->end_time)
                      ->where('end_time', '>=', $request->end_time);
                })->orWhere(function($q) use ($request) {
                    $q->where('start_time', '>=', $request->start_time)
                      ->where('end_time', '<=', $request->end_time);
                });
            })
            ->exists();

        if ($conflict) {
            return redirect()->back()
                ->withErrors(['schedule' => 'Schedule conflicts with existing schedule for this program.'])
                ->withInput();
        }

        Schedule::create([
            'program_id' => $request->program_id,
            'day_of_week' => $request->day_of_week,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
            'max_students' => $request->max_students ?? 10,
            'is_active' => $request->has('is_active'),
        ]);

        return redirect()->route('admin.schedules.index')
            ->with('success', 'Schedule created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Schedule $schedule)
    {
        $schedule->load(['program.service', 'registrations' => function($query) {
            $query->latest()->take(10);
        }]);

        return view('admin.schedules.show', compact('schedule'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Schedule $schedule)
    {
        $programs = Program::active()->with('service')->get();
        return view('admin.schedules.edit', compact('schedule', 'programs'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Schedule $schedule)
    {
        $validator = Validator::make($request->all(), [
            'program_id' => 'required|exists:programs,id',
            'day_of_week' => 'required|integer|between:1,7',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
            'max_students' => 'nullable|integer|min:1',
            'is_active' => 'boolean',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Check for schedule conflicts (excluding current schedule)
        $conflict = Schedule::where('program_id', $request->program_id)
            ->where('day_of_week', $request->day_of_week)
            ->where('id', '!=', $schedule->id)
            ->where(function($query) use ($request) {
                $query->where(function($q) use ($request) {
                    $q->where('start_time', '<=', $request->start_time)
                      ->where('end_time', '>', $request->start_time);
                })->orWhere(function($q) use ($request) {
                    $q->where('start_time', '<', $request->end_time)
                      ->where('end_time', '>=', $request->end_time);
                })->orWhere(function($q) use ($request) {
                    $q->where('start_time', '>=', $request->start_time)
                      ->where('end_time', '<=', $request->end_time);
                });
            })
            ->exists();

        if ($conflict) {
            return redirect()->back()
                ->withErrors(['schedule' => 'Schedule conflicts with existing schedule for this program.'])
                ->withInput();
        }

        $schedule->update([
            'program_id' => $request->program_id,
            'day_of_week' => $request->day_of_week,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
            'max_students' => $request->max_students ?? 10,
            'is_active' => $request->has('is_active'),
        ]);

        return redirect()->route('admin.schedules.index')
            ->with('success', 'Schedule updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Schedule $schedule)
    {
        // Check if schedule has registrations
        if ($schedule->registrations()->count() > 0) {
            return redirect()->back()
                ->with('error', 'Cannot delete schedule with existing registrations.');
        }

        $schedule->delete();

        return redirect()->route('admin.schedules.index')
            ->with('success', 'Schedule deleted successfully.');
    }

    /**
     * Toggle schedule active status
     */
    public function toggle(Schedule $schedule)
    {
        $schedule->update(['is_active' => !$schedule->is_active]);

        return redirect()->back()
            ->with('success', 'Schedule status updated successfully.');
    }

    /**
     * Get available schedules for a program (AJAX)
     */
    public function getByProgram(Program $program)
    {
        $schedules = $program->schedules()
            ->active()
            ->orderBy('day_of_week')
            ->orderBy('start_time')
            ->get(['id', 'day_of_week', 'start_time', 'end_time', 'max_students']);

        return response()->json($schedules);
    }

    /**
     * Get schedule calendar data
     */
    public function calendar(Request $request)
    {
        $start = $request->get('start', now()->startOfMonth());
        $end = $request->get('end', now()->endOfMonth());

        $schedules = Schedule::with('program.service')
            ->where('is_active', true)
            ->get()
            ->map(function($schedule) {
                $days = ['sunday', 'monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday'];
                $dayName = $days[$schedule->day_of_week - 1];

                return [
                    'id' => $schedule->id,
                    'title' => $schedule->program->name,
                    'start' => $schedule->start_time,
                    'end' => $schedule->end_time,
                    'daysOfWeek' => [$schedule->day_of_week - 1], // FullCalendar uses 0-6 for days
                    'extendedProps' => [
                        'program' => $schedule->program->name,
                        'service' => $schedule->program->service->name,
                        'max_students' => $schedule->max_students,
                    ],
                ];
            });

        return response()->json($schedules);
    }
}
