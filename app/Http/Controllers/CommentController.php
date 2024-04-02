<?php
namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use App\Http\Requests\StoreCommentRequest;
use App\Http\Requests\UpdateCommentRequest;
use Illuminate\Support\Str;


class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
    	$comments = Comment::where('id', '>', -1)
        ->orderBy('created_at', 'desc');

        if ($request->input('page') == null || 
            $request->input('page') == '') {
            $comments = $comments->get();
        } else {
            $comments = $comments->paginate();
        }

        $data = [
            'success' => true,
            'comments' => $comments
        ];

        return response()->json($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCommentRequest $request)
    {
        $validated = $request->validated();

        $comment = new Comment;

        $comment->description = $validated['description'] ?? null;
		$comment->score = $validated['score'] ?? null;
		$comment->product_id = $validated['product_id'] ?? null;
		$comment->user_id = $validated['user_id'] ?? null;
		
        $comment->save();

        $data = [
            'success'       => true,
            'comment'   => $comment
        ];
        
        return response()->json($data);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function show(Comment $comment)
    {
        $data = [
            'success' => true,
            'comment' => $comment
        ];

        return response()->json($data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function edit(Comment $comment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCommentRequest $request, Comment $comment)
    {
        $validated = $request->validated();

        $comment->description = $validated['description'] ?? null;
		$comment->score = $validated['score'] ?? null;
		$comment->product_id = $validated['product_id'] ?? null;
		$comment->user_id = $validated['user_id'] ?? null;
		
        $comment->save();

        $data = [
            'success'       => true,
            'comment'   => $comment
        ];
        
        return response()->json($data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Comment $comment)
    {   
        $comment->delete();

        $data = [
            'success' => true,
            'comment' => $comment
        ];

        return response()->json($data);
    }
}