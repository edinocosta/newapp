<?php

namespace App\Policies;

use App\User;
use App\Auditoria;
use Illuminate\Auth\Access\HandlesAuthorization;

class AuditoriaPolicy
{
    use HandlesAuthorization;


     private function usercan(User $user){

         if(User::isAdmin($user)) return true;
         return $user->tipouser->permission()->get()->contains("nomePermissao","Criar Auditora");

    }

    /**
     * Determine whether the user can view the auditoria.
     *
     * @param  \App\User  $user
     * @param  \App\Auditoria  $auditoria
     * @return mixed
     */
    public function view(User $user)
    {
         return $this->usercan($user);
    }

    /**
     * Determine whether the user can create auditorias.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $this->usercan($user);
    }

    /**
     * Determine whether the user can update the auditoria.
     *
     * @param  \App\User  $user
     * @param  \App\Auditoria  $auditoria
     * @return mixed
     */
    public function update(User $user)
    {
        return $this->userCan($user);
    }

    /**
     * Determine whether the user can delete the auditoria.
     *
     * @param  \App\User  $user
     * @param  \App\Auditoria  $auditoria
     * @return mixed
     */
    public function delete(User $user)
    {
         return $this->userCan($user);
    }

    /**
     * Determine whether the user can restore the auditoria.
     *
     * @param  \App\User  $user
     * @param  \App\Auditoria  $auditoria
     * @return mixed
     */
    public function restore(User $user)
    {
         return $this->userCan($user);
    }

    /**
     * Determine whether the user can permanently delete the auditoria.
     *
     * @param  \App\User  $user
     * @param  \App\Auditoria  $auditoria
     * @return mixed
     */
    public function forceDelete(User $user)
    {
        
        return $this->userCan($user);
    }

   
}
