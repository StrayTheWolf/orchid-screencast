<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Orchid\Filters\Filterable;
use Orchid\Metrics\Chartable;
use Orchid\Screen\AsSource;

class Client extends Model
{
    use Chartable;
    use HasFactory;
    use AsSource;
    use Filterable;

    protected $fillable = ['phone', 'name', 'last_name', 'status', 'email', 'birthday', 'service_id', 'assessment'];

    protected $allowedSorts = [
        'status'
    ];
    protected $allowedFilters = [
        'phone'
    ];

    public const STATUS = [
        'interviewed' => 'Опрошен',
        'not_interviewed' => 'Не опрошен'
    ];

    public function setPhoneAttribute($phoneCandidate)
    {
        $this->attributes['phone'] =  make_phone_normalized($phoneCandidate);
    }

    public function service(): BelongsTo
    {
        return $this->belongsTo(Service::class);
    }
}
