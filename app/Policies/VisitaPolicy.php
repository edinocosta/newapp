<?php

namespace App\Policies;

use App\User;
use App\Visita;
use Illuminate\Auth\Access\HandlesAuthorization;

class VisitaPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the visita.
     *
     * @param  \App\User  $user
     * @param  \App\Visita  $visita
     * @return mixed
     */
    public function view(User $user, Visita $visita)
    {
        //
    }

    /**
     * Determine whether the user can create visitas.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the visita.
     *
     * @param  \App\User  $user
     * @param  \App\Visita  $visita
     * @return mixed
     */
    public function update(User $user, Visita $visita)
    {
        //
    }

    /**
     * Determine whether the user can delete the visita.
     *
     * @param  \App\User  $user
     * @param  \App\Visita  $visita
     * @return mixed
     */
    public function delete(User $user, Visita $visita)
    {
        //
    }

    /**
     * Determine whether the user can restore the visita.
     *
     * @param  \App\User  $user
     * @param  \App\Visita  $visita
     * @return mixed
     */
    public function restore(User $user, Visita $visita)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the visita.
     *
     * @param  \App\User  $user
     * @param  \App\Visita  $visita
     * @return mixed
     */
    public function forceDelete(User $user, Visita $visita)
    {
        //
    }
}
