<?php

namespace App\Http\Controllers\SINTAS;

use App\Http\Controllers\Controller;
use App\Mail\LateCheckIn;
use App\Models\SINTAS\Attendance;
use App\Exports\AttendanceExport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Excel as ExcelWriter;

class AttendanceController extends Controller
{
    /**
     * Display attendance dashboard for employees.
     */
    public function index()
    {
        $user = Auth::user();
        
        // Get today's attendance
        $todayAttendance = Attendance::where('user_id', $user->id)
            ->whereDate('date', today())
            ->first();
        
        // Get this month's attendance
        $monthlyAttendances = Attendance::where('user_id', $user->id)
            ->whereYear('date', now()->year)
            ->whereMonth('date', now()->month)
            ->orderBy('date', 'desc')
            ->get();
        
        // Calculate statistics
        $stats = [
            'total_days' => $monthlyAttendances->count(),
            'present_days' => $monthlyAttendances->where('status', 'present')->count(),
            'late_days' => $monthlyAttendances->where('status', 'late')->count(),
            'absent_days' => $monthlyAttendances->where('status', 'absent')->count(),
            'leave_days' => $monthlyAttendances->whereIn('status', ['leave', 'sick', 'permission'])->count(),
        ];
        
        return view('SINTAS/Superadmin/superadmin-attendance/index', compact('todayAttendance', 'monthlyAttendances', 'stats'));
    }

    /**
     * Check in attendance.
     */
    public function checkIn(Request $request)
    {
        $user = Auth::user();
        
        // Check if already checked in today
        $attendance = Attendance::where('user_id', $user->id)
            ->whereDate('date', today())
            ->first();
        
        if ($attendance && $attendance->check_in) {
            return back()->with('error', 'Anda sudah melakukan check-in hari ini.');
        }
        
        $checkInTime = now();
        $standardTime = now()->setTime(9, 0, 0);
        $status = $checkInTime->gt($standardTime) ? 'late' : 'present';
        
        $attendance = Attendance::updateOrCreate(
            [
                'user_id' => $user->id,
                'date' => today(),
            ],
            [
                'check_in' => $checkInTime,
                'status' => $status,
                'location' => $request->input('location', 'Office'),
                'ip_address' => $request->ip(),
            ]
        );

        // Send email notification if late
        if ($status === 'late') {
            Mail::mailer('smtp')->to($user->email)->send(new LateCheckIn($attendance));
        }

        $message = $status === 'late'
            ? 'Check-in berhasil! Anda terlambat.'
            : 'Check-in berhasil!';

        return back()->with('success', $message);
    }

    /**
     * Check out attendance.
     */
    public function checkOut(Request $request)
    {
        $user = Auth::user();
        
        $attendance = Attendance::where('user_id', $user->id)
            ->whereDate('date', today())
            ->first();
        
        if (!$attendance || !$attendance->check_in) {
            return back()->with('error', 'Anda belum melakukan check-in hari ini.');
        }
        
        if ($attendance->check_out) {
            return back()->with('error', 'Anda sudah melakukan check-out hari ini.');
        }
        
        $attendance->update([
            'check_out' => now(),
            'notes' => $request->input('notes'),
        ]);
        
        return back()->with('success', 'Check-out berhasil!');
    }

    /**
     * Display attendance history.
     */
    public function history(Request $request)
    {
        $user = Auth::user();
        
        $query = Attendance::where('user_id', $user->id);
        
        // Apply filters
        if ($request->filled('month')) {
            $date = \Carbon\Carbon::parse($request->month);
            $query->whereYear('date', $date->year)
                  ->whereMonth('date', $date->month);
        }
        
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }
        
        $attendances = $query->orderBy('date', 'desc')->paginate(31);
        
        return view('SINTAS/Superadmin/superadmin-attendance/history', compact('attendances'));
    }

    /**
     * Admin view - all employees attendance.
     */
    public function adminIndex(Request $request)
    {
        $query = Attendance::with('user');
        
        // Apply filters
        if ($request->filled('date')) {
            $query->whereDate('date', $request->date);
        } else {
            $query->whereDate('date', today());
        }
        
        if ($request->filled('department')) {
            $query->whereHas('user', function($q) use ($request) {
                $q->where('department', $request->department);
            });
        }
        
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }
        
        $attendances = $query->orderBy('date', 'desc')
            ->orderBy('check_in', 'asc')
            ->paginate(50);
        
        // Get departments for filter
        $departments = \App\Models\User::whereNotNull('department')
            ->distinct()
            ->pluck('department');
        
        return view('SINTAS/Superadmin/superadmin-attendance/superadmin.attdb', compact('attendances', 'departments'));
    }

    /**
     * Export attendance report.
     */
    public function export(Request $request)
    {
        $query = Attendance::with('user');

        // Apply same filters as admin index
        if ($request->filled('date')) {
            $query->whereDate('date', $request->date);
        } else {
            $query->whereDate('date', today());
        }

        if ($request->filled('department')) {
            $query->whereHas('user', function($q) use ($request) {
                $q->where('department', $request->department);
            });
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $filename = 'attendance_report_' . now()->format('Y-m-d_H-i-s') . '.xlsx';

        return Excel::download(new AttendanceExport($query), $filename);
    }
}
