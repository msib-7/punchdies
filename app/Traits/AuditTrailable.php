<?php

namespace App\Traits;

use App\Models\Audit_tr;
use Illuminate\Support\Str;

trait AuditTrailable
{
    public static function bootAuditTrailable()
    {
        static::creating(function ($model) {
            $model->logCreate();
        });

        static::updating(function ($model) {
            $model->logUpdate();
        });

        static::deleting(function ($model) {
            $model->logDelete();
        });
    }

    protected function logCreate()
    {
        // Generate UUID if the model does not have one
        if (empty($this->{$this->getKeyName()})) {
            $this->{$this->getKeyName()} = (string) Str::uuid();
        }

        // Log when data is created
        $this->createAuditLog('created', [
            'new_data' => $this->getAttributes(),
            'reason' => 'Initial creation',
            'how' => 'Form submission',
        ]);
    }

    protected function logUpdate()
    {
        // Log when data is updated
        $this->createAuditLog('updated', [
            'old_data' => $this->getOriginal(),
            'new_data' => $this->getAttributes(),
            'reason' => 'Data modification',
            'how' => 'Form submission',
        ]);
    }

    protected function logDelete()
    {
        // Log when data is deleted
        $this->createAuditLog('deleted', [
            'old_data' => $this->getAttributes(),
            'reason' => 'Data removal',
            'how' => 'Admin action',
        ]);
    }

    protected function createAuditLog($action, $additionalData = [])
    {
        $ip = request()->ip();
        // Check if the IP is localhost and try to get the forwarded IP
        if ($ip === '127.0.0.1' || $ip === '::1') {
            $ip = request()->header('X-Forwarded-For') ?: $ip;
        }

        \Log::info('User  IP: ' . $ip); // Log the IP for debugging

        Audit_tr::create(array_merge([
            'model' => get_class($this),
            'model_id' => $this->id,
            'action' => $action,
            'user_id' => auth()->id(),
            'timestamp' => now(),
            'location' => $ip,
        ], $additionalData));
    }
}