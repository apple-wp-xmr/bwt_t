<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\FeedbackRequest;
use Illuminate\Http\Request;
use App\Models\Feedback;
use Illuminate\Http\JsonResponse;

class FeedbackController extends Controller
{
        /**
     * List all feedback messages.
     */
    public function index(): JsonResponse
    {
        $feedbacks = Feedback::orderBy('created_at', 'desc')->get();

        return response()->json($feedbacks);
    }

    /**
     * Store a new feedback message.
     */
    public function store(FeedbackRequest $request): JsonResponse
    {
        $data = $request->validated();
        $data['user_id'] = $request->user()->id;
        $data['name'] = $request->user()->name;
        $data['email'] = $request->user()->email;

        $feedback = Feedback::create($data);

        return response()->json($feedback, 201);
    }
}
