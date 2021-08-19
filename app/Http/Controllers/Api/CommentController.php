<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\StoreCommentRequest;
use App\Jobs\AddNewComment;

class CommentController extends Controller
{
    public function store (StoreCommentRequest $request) {

        AddNewComment::dispatch($request['subject'], $request['body'], $request['article_id']);

        return response()->json(['status' => 'success',], 201);
    }
}
