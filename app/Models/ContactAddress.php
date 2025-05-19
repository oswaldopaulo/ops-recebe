<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ContactAddress extends Model
{
    use SoftDeletes;

    protected $table = 'contact_addresses';
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'contactid',
        'descricao',
        'cep',
        'endereco',
        'bairro',
        'cidade',
        'uf',
        'numero',
        'referencia',
        'complemento',
    ];

    /**
     * Get the contact that owns the address.
     */
    public function contact(): BelongsTo
    {
        return $this->belongsTo(Contact::class, 'contactid');
    }
}
