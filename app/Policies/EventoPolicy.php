<?php

namespace App\Policies;

use App\User;
use App\Evento;
use Illuminate\Auth\Access\HandlesAuthorization;

class EventoPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the evento.
     *
     * @param  \App\User  $user
     * @param  \App\Evento  $evento
     * @return mixed
     */
    public function view(User $user, Evento $evento)
    {
        //
    }

    /**
     * Determine whether the user can create eventos.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
       return User::isAdmin($user);
       return $user->tipouser->permission()->get()->contains("nomePermissao","Adicionar Eventos");
    }

    /**
     * Determine whether the user can update the evento.
     *
     * @param  \App\User  $user
     * @param  \App\Evento  $evento
     * @return mixed
     */
    public function update(User $user, Evento $evento)
    {
         return $user->id ==  $evento->idUser;
    }

    /**
     * Determine whether the user can delete the evento.
     *
     * @param  \App\User  $user
     * @param  \App\Evento  $evento
     * @return mixed
     */
    public function delete(User $user, Evento $evento)
    {
        //
    }

    /**
     * Determine whether the user can restore the evento.
     *
     * @param  \App\User  $user
     * @param  \App\Evento  $evento
     * @return mixed
     */
    public function restore(User $user, Evento $evento)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the evento.
     *
     * @param  \App\User  $user
     * @param  \App\Evento  $evento
     * @return mixed
     */
    public function forceDelete(User $user, Evento $evento)
    {
        //
    }

   
}
