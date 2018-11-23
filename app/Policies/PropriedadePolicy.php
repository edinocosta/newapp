<?php

namespace App\Policies;

use App\User;
use App\Propriedade;
use Illuminate\Auth\Access\HandlesAuthorization;

class PropriedadePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the propriedade.
     *
     * @param  \App\User  $user
     * @param  \App\Propriedade  $propriedade
     * @return mixed
     */
    
    private function usercan(User $user){

         if(User::isAdmin($user)) return true;
         return $user->tipouser->permission()->get()->contains("nomePermissao","Criar Auditora");

    }



    public function view(User $user, Propriedade $propriedade)
    {
        //
    }

    /**
     * Determine whether the user can create propriedades.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $this->usercan($user);
    }

    /**
     * Determine whether the user can update the propriedade.
     *
     * @param  \App\User  $user
     * @param  \App\Propriedade  $propriedade
     * @return mixed
     */
    public function update(User $user, Propriedade $propriedade)
    {
        //
    }

    /**
     * Determine whether the user can delete the propriedade.
     *
     * @param  \App\User  $user
     * @param  \App\Propriedade  $propriedade
     * @return mixed
     */
    public function delete(User $user, Propriedade $propriedade)
    {
        //
    }

    /**
     * Determine whether the user can restore the propriedade.
     *
     * @param  \App\User  $user
     * @param  \App\Propriedade  $propriedade
     * @return mixed
     */
    public function restore(User $user, Propriedade $propriedade)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the propriedade.
     *
     * @param  \App\User  $user
     * @param  \App\Propriedade  $propriedade
     * @return mixed
     */
    public function forceDelete(User $user, Propriedade $propriedade)
    {
        //
    }
}
