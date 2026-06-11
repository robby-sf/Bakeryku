<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActivityLog extends Model
{
    use HasFactory;

    protected $table = 'activity_logs';

    protected $fillable = [
        'user_id',
        'type',
        'title',
        'description',
    ];

    /**
     * Get the user that performed the activity.
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Helper to log an activity easily.
     */
    public static function log(string $type, string $title, string $description, ?int $userId = null): self
    {
        return self::create([
            'user_id' => $userId ?? auth()->guard('user')->id() ?? auth()->guard('admin')->id(),
            'type' => $type,
            'title' => $title,
            'description' => $description,
        ]);
    }
}
