<?php

namespace App\Policies;

use App\Models\BoardList;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class BoardListPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return false;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, BoardList $boardList): Response
    {
        return $boardList->board->workspace->user_id === $user->id ? Response::allow():Response::denyAsNotFound('Board list not found.');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return false;
    }

    public function createCard(User $user, BoardList $boardList){
        return $boardList->board->workspace->user_id === $user->id ? Response::allow():Response::denyAsNotFound('Board list not found.');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, BoardList $boardList): Response
    {
        return $boardList->board->workspace->user_id === $user->id ? Response::allow():Response::denyAsNotFound('Board list not found.');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, BoardList $boardList): Response
    {
        return $boardList->board->workspace->user_id === $user->id ? Response::allow():Response::denyAsNotFound('Board list not found.');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, BoardList $boardList): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, BoardList $boardList): bool
    {
        return false;
    }
}
