<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ContactContact extends Model
{
    protected $table = 'contact_contacts';
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'contactid',
        'descricao',
        'tipo',
        'valor',
    ];

    /**
     * Get the contact that owns this contact method.
     */
    public function contact(): BelongsTo
    {
        return $this->belongsTo(Contact::class, 'contactid');
    }

    /**
     * Get the type name based on the tipo value.
     *
     * @return string
     */
    public function getTypeNameAttribute(): string
    {
        return match($this->tipo) {
            0 => 'Telefone',
            1 => 'Email',
            2 => 'Celular',
            default => 'Outro',
        };
    }
}
