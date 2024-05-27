<?php

namespace App\Policies;

use App\Models\Book;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class BookPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Book $book): bool
    {
        //
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     */
    // 本の更新権限の確認
    public function update(User $user, Book $book): bool
    {
        return $user->id === $book->user_id; // ユーザーが本の所有者である場合に true を返す
    }

    /**
     * Determine whether the user can delete the model.
     */

    // 本の削除権限の確認
    public function delete(User $user, Book $book): bool
    {
        return $user->id === $book->user_id; // ユーザーが本の所有者である場合に true を返す
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Book $book): bool
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Book $book): bool
    {
        //
    }

    // ---------------------------ここから追記---------------------------
}