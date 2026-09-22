<?php

namespace App\Traits;

use App\Models\Audit;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;

trait Auditable
{
    protected static function bootAuditable(): void
    {
        static::created(function ($model): void {
            $model->writeAudit('created', [], $model->auditAttributes($model->getAttributes()));
        });

        static::updated(function ($model): void {
            $changes = $model->getChanges();
            $original = array_intersect_key($model->getOriginal(), $changes);
            $model->writeAudit('updated', $model->auditAttributes($original), $model->auditAttributes($changes));
        });

        static::deleted(function ($model): void {
            $model->writeAudit('deleted', $model->auditAttributes($model->getOriginal()), []);
        });
    }

    protected function auditAttributes(array $attributes): array
    {
        unset($attributes['password'], $attributes['remember_token']);

        return $attributes;
    }

    protected function writeAudit(string $action, array $oldValues, array $newValues): void
    {
        Audit::create([
            'user_id' => Auth::id(),
            'action' => $action,
            'auditable_type' => static::class,
            'auditable_id' => (string) $this->getKey(),
            'old_values' => $oldValues ?: null,
            'new_values' => $newValues ?: null,
            'ip_address' => Request::ip(),
            'user_agent' => Request::userAgent(),
            'url' => Request::fullUrl(),
        ]);
    }
}
