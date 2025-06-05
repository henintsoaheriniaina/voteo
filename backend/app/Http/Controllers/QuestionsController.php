<?php

namespace App\Http\Controllers;

use App\Events\QuestionCreated;
use App\Models\Question;
use App\Models\Vote;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Str;

class QuestionsController extends Controller implements HasMiddleware
{
    /**
     * Summary of middleware
     * @return Middleware[]
     */
    public static function middleware()
    {
        return [
            new Middleware('auth:sanctum', except: ['show', 'index']),
        ];
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $questions = Question::latest()->with(["user", "options"])->paginate(12);
        return response(["questions" => $questions]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $fields = $request->validate([
            'title' => 'string|required|max:255',
            'options.*' => 'string|required|max:255',
            'options' => 'array|required|min:2',
        ]);
        $slug = Str::slug($fields['title']);

        $originalSlug = $slug;
        $count = 1;
        while (Question::where('slug', $slug)->exists()) {
            $slug = "{$originalSlug}-{$count}";
            $count++;
        }

        $question = $request->user()->questions()->create([
            "title" => $fields["title"],
            "slug" => $slug
        ]);

        foreach ($fields["options"] as $option) {
            $question->options()->create([
                "label" => $option,
            ]);
        }

        $question = $question->load(['user', 'options']);
        broadcast(
            new QuestionCreated($question)
        );
        return response([
            "message" => "Question created successfully",
            "question" => $question
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Question $question)
    {
        return response([
            "question" => $question->load(['user', 'options.votes.user']),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Question $question)
    {
        $fields = $request->validate([
            'title' => 'string|required|max:255',
            'options.*' => 'string|required|max:255',
            'options' => 'array|required|min:2'
        ]);
        $slug = Str::slug($fields['title']);

        $originalSlug = $slug;
        $count = 1;
        while (Question::where('slug', $slug)->exists()) {
            $slug = "{$originalSlug}-{$count}";
            $count++;
        }

        $question->update([
            "title" => $fields["title"],
            "slug" => $slug
        ]);

        $question->options()->delete();

        foreach ($fields["options"] as $option) {
            $question->options()->create([
                "label" => $option,
            ]);
        }

        $question->save();
        return response([
            "message" => "Question updated successfully",
            "question" => $question->load(['user', 'options'])
        ], 201);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Question $question)
    {
        $question->delete();
        return response([
            'message' => 'Question deleted successfully',
        ]);
    }
}
