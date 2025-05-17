<?php namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Major extends Model {
    use HasFactory;
    protected $fillable = ['course_id', 'name'];

    public function course(): BelongsTo {
        return $this->belongsTo(Course::class);
    }
}