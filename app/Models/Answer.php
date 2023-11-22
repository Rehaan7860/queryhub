<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Answer extends Model
{
    use HasFactory;

    protected $fillable = ['body', 'user_id'];

    public function question() {
        return $this->belongsTo(Question::class);
    }

    public function User() {
        return $this->belongsTo(User::class);
    }

    public function getBodyHtmlAttribute() {
        return Str::markdown($this->body);
    }

    public static function boot() {
        parent::boot();

        static::created(function ($answer) {
            $answer->question->increment('answers_count');
            $answer->question->save();
        });

    }

    public function getCreatedDateAttribute() {

        return $this->created_at->diffForHumans();

    }
}
