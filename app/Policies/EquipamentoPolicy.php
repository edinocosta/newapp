<?php

namespace App\Policies;

use App\User;
use App\Equipamento;
use Illuminate\Auth\Access\HandlesAuthorization;

class EquipamentoPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the equipamento.
     *
     * @param  \App\User  $user
     * @param  \App\Equipamento  $equipamento
     * @return mixed
     */
    public function view(User $user, Equipamento $equipamento)
    {
        //
    }

    /**
     * Determine whether the user can create equipamentos.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
         if(User::isAdmin($user)) return true;
         return $user->tipouser->permission()->get()->contains("nomePermissao","Adicionar Equipamentos");
    }

    /**
     * Determine whether the user can update the equipamento.
     *
     * @param  \App\User  $user
     * @param  \App\Equipamento  $equipamento
     * @return mixed
     */
    public function update(User $user, Equipamento $equipamento)
    {
        //
    }

    /**
     * Determine whether the user can delete the equipamento.
     *
     * @param  \App\User  $user
     * @param  \App\Equipamento  $equipamento
     * @return mixed
     */
    public function delete(User $user, Equipamento $equipamento)
    {
        //
    }

    /**
     * Determine whether the user can restore the equipamento.
     *
     * @param  \App\User  $user
     * @param  \App\Equipamento  $equipamento
     * @return mixed
     */
    public function restore(User $user, Equipamento $equipamento)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the equipamento.
     *
     * @param  \App\User  $user
     * @param  \App\Equipamento  $equipamento
     * @return mixed
     */
    public function forceDelete(User $user, Equipamento $equipamento)
    {
        //
    }
}
