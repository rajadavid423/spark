<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Student extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function subjects()
    {
        return $this->belongsToMany(Subject::class, 'student_subject', 'student_id', 'subject_id');
    }

    protected $appends = ["first_subject", 'last_subject'];

    public function getFirstSubjectAttribute() {
        $data = DB::table('student_subject')->where('student_id', $this->id)
            ->join('subjects', 'subjects.id', '=', 'student_subject.subject_id')
            ->select('subjects.id as subject_id', 'subjects.name as subject', 'student_subject.mark', 'student_subject.created_at')
            ->orderBy('created_at')
            ->first();
        return $data ?? null;
    }

    public function getLastSubjectAttribute() {
        $data = DB::table('student_subject')->where('student_id', $this->id)
            ->join('subjects', 'subjects.id', '=', 'student_subject.subject_id')
            ->select('subjects.id as subject_id', 'subjects.name as subject', 'student_subject.mark', 'student_subject.created_at')
            ->orderBy('created_at', 'desc')
            ->first();
        return $data ?? null;
    }
}
