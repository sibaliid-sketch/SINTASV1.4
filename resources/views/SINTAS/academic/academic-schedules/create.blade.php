@extends('layouts.admin')

@section('title', 'Create Schedule')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Create New Schedule</h3>
                    <div class="card-tools">
                        <a href="{{ route('admin.schedules.index') }}" class="btn btn-secondary btn-sm">
                            <i class="fas fa-arrow-left"></i> Back to Schedules
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.schedules.store') }}" method="POST">
                        @csrf

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="program_id">Program <span class="text-danger">*</span></label>
                                    <select name="program_id" id="program_id" class="form-control @error('program_id') is-invalid @enderror" required>
                                        <option value="">Select Program</option>
                                        @foreach($programs as $program)
                                            <option value="{{ $program->id }}" {{ old('program_id') == $program->id ? 'selected' : '' }}>
                                                {{ $program->name }} ({{ $program->service->name }})
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('program_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="day_of_week">Day of Week <span class="text-danger">*</span></label>
                                    <select name="day_of_week" id="day_of_week" class="form-control @error('day_of_week') is-invalid @enderror" required>
                                        <option value="">Select Day</option>
                                        <option value="1" {{ old('day_of_week') == '1' ? 'selected' : '' }}>Monday</option>
                                        <option value="2" {{ old('day_of_week') == '2' ? 'selected' : '' }}>Tuesday</option>
                                        <option value="3" {{ old('day_of_week') == '3' ? 'selected' : '' }}>Wednesday</option>
                                        <option value="4" {{ old('day_of_week') == '4' ? 'selected' : '' }}>Thursday</option>
                                        <option value="5" {{ old('day_of_week') == '5' ? 'selected' : '' }}>Friday</option>
                                        <option value="6" {{ old('day_of_week') == '6' ? 'selected' : '' }}>Saturday</option>
                                        <option value="7" {{ old('day_of_week') == '7' ? 'selected' : '' }}>Sunday</option>
                                    </select>
                                    @error('day_of_week')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="start_time">Start Time <span class="text-danger">*</span></label>
                                    <input type="time" name="start_time" id="start_time"
                                           class="form-control @error('start_time') is-invalid @enderror"
                                           value="{{ old('start_time') }}" required>
                                    @error('start_time')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="end_time">End Time <span class="text-danger">*</span></label>
                                    <input type="time" name="end_time" id="end_time"
                                           class="form-control @error('end_time') is-invalid @enderror"
                                           value="{{ old('end_time') }}" required>
                                    @error('end_time')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="max_students">Max Students</label>
                                    <input type="number" name="max_students" id="max_students"
                                           class="form-control @error('max_students') is-invalid @enderror"
                                           value="{{ old('max_students', 10) }}" min="1">
                                    @error('max_students')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" name="is_active" id="is_active"
                                       class="custom-control-input" {{ old('is_active', true) ? 'checked' : '' }}>
                                <label for="is_active" class="custom-control-label">Active</label>
                            </div>
                        </div>

                        @error('schedule')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Create Schedule
                            </button>
                            <a href="{{ route('admin.schedules.index') }}" class="btn btn-secondary">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
$(document).ready(function() {
    // Add time validation
    $('#start_time, #end_time').on('change', function() {
        var startTime = $('#start_time').val();
        var endTime = $('#end_time').val();

        if (startTime && endTime) {
            if (startTime >= endTime) {
                $('#end_time').addClass('is-invalid');
                $('#end_time').after('<div class="invalid-feedback">End time must be after start time.</div>');
            } else {
                $('#end_time').removeClass('is-invalid');
                $('#end_time').next('.invalid-feedback').remove();
            }
        }
    });
});
</script>
@endsection
