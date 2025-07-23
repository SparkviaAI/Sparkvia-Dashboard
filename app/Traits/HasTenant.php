<?php

declare(strict_types=1);

namespace App\Traits;

use App\Models\Tenant;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property Tenant $tenant
 * @property bool $isDefault
 * @method static Builder default()
 */
trait HasTenant
{
    public static function bootHasTenant(): void
    {
        static::addGlobalScope('tenant', function (Builder $query) {
            return $query->where('tenant_id', config('app.tenant_id'));
        });
    }

    public function tenant(): BelongsTo
    {
        return $this->belongsTo(Tenant::class);
    }

    public function scopeDefault(Builder $query): Builder
    {
        return $query->withoutGlobalScope('tenant')->whereNull('tenant_id');
    }

    public function getIsDefaultAttribute(): bool
    {
        return $this->tenant_id == null;
    }
}
