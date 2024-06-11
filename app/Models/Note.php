<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Note extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['user_id', 'uuid', 'title', 'text', 'status'];

    public function getRouteKeyName()
    {
        return 'uuid';
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function transactions()
    {
        return $this->belongsToMany(Transaction::class, 'transaction_details')
            ->withPivot('transaction_id', 'note_id')
            ->withTimestamps();
    }
}
