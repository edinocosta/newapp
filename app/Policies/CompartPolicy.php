<?php

namespace App\Policies;

use App\User;
use App\Compartimento;
use Illuminate\Auth\Access\HandlesAuthorization;

class CompartPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the compartimento.
     *
     * @param  \App\User  $user
     * @param  \App\Compartimento  $compartimento
     * @return mixed
     */
    public function view(User $user, Compartimento $compartimento)
    {
        //
    }

    /**
     * Determine whether the user can create compartimentos.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
         if(User::isAdmin($user)) return true;
         return $user->tipouser->permission()->get()->contains("nomePermissao","Criar Auditora");
    }

    /**
     * Determine whether the user can update the compartimento.
     *
     * @param  \App\User  $user
     * @param  \App\Compartimento  $compartimento
     * @return mixed
     */
    public function update(User $user, Compartimento $compartimento)
    {
        //
    }

    /**
     * Determine whether the user can delete the compartimento.
     *
     * @param  \App\User  $user
     * @param  \App\Compartimento  $compartimento
     * @return mixed
     */
    public function delete(User $user, Compartimento $compartimento)
    {
        //
    }

    /**
     * Determine whether the user can restore the compartimento.
     *
     * @param  \App\User  $user
     * @param  \App\Compartimento  $compartimento
     * @return mixed
     */
    public function restore(User $user, Compartimento $compartimento)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the compartimento.
     *
     * @param  \App\User  $user
     * @param  \App\Compartimento  $compartimento
     * @return mixed
     */
    public function forceDelete(User $user, Compartimento $compartimento)
    {
        //
    }
}
