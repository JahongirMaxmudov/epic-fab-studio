<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    /**
     * Display a listing of comments.
     */
    public function index(Request $request): View
    {
        $query = Comment::with('commentable');

        if ($request->filled('status')) {
            $isApproved = $request->input('status') === 'approved';
            $query->where('is_approved', $isApproved);
        }

        $comments = $query->latest()->paginate(20)->withQueryString();

        return view('admin.comments.index', ['comments' => $comments]);
    }

    /**
     * Approve the comment.
     */
    public function approve(int $id): RedirectResponse
    {
        $comment = Comment::findOrFail($id);
        $comment->update(['is_approved' => true]);

        return back()->with('success', 'Отзыв одобрен и опубликован.');
    }

    /**
     * Remove the specified comment.
     */
    public function destroy(int $id): RedirectResponse
    {
        $comment = Comment::findOrFail($id);
        $comment->delete();

        return back()->with('success', 'Отзыв удален.');
    }
}
