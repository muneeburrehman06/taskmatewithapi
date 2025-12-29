<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\User;

class Task extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     * We only want the user to control these fields.
     */
    protected $fillable = [
        'title',
        'description',
        'is_completed',
        'user_id', // Although we usually set this automatically, listing it helps.
    ];

    /**
     * Get the user that owns the Task.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
