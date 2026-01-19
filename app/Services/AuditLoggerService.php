<?php

namespace App\Services;

use App\Models\AuditLog;
use Illuminate\Support\Facades\Auth;

class AuditLoggerService
{
    public static function log(
        string $action,
        string $modelType,
        int $modelId,
        array $changes = [],
        string $notes = ''
    ): void {
        $user = Auth::user();

        AuditLog::create([
            'action' => $action,
            'model_type' => $modelType,
            'model_id' => $modelId,
            'user_id' => $user?->id,
            'user_name' => $user?->name ?? 'System',
            'changes' => $changes,
            'notes' => $notes,
            'ip_address' => request()->ip(),
        ]);
    }
}
