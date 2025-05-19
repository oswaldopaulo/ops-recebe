<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Contact extends Model
{
    use SoftDeletes;

    protected $table = 'contacts';
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'userid',
        'name',
        'document',
        'type',
        'active',
    ];

    /**
     * Get the user that owns the contact.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'userid');
    }

    /**
     * Get the addresses for the contact.
     */
    public function addresses(): HasMany
    {
        return $this->hasMany(ContactAddress::class, 'contactid');
    }

    /**
     * Get the contact methods for the contact.
     */
    public function contactMethods(): HasMany
    {
        return $this->hasMany(ContactContact::class, 'contactid');
    }
}
