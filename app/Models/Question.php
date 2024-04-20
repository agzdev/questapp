<?php

namespace App\Models;

use App\Http\Requests\QuestionRequest;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Question extends Model
{
    use HasFactory;

    public function store(QuestionRequest $request)
    {
        $question = $this::create([
            "title" => $request->title,
            "text" => $request->text,
        ]);




    }
}
