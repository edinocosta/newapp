<?php

namespace App\Policies;

use App\User;
use App\EstadoAuditoria;
use Illuminate\Auth\Access\HandlesAuthorization;

class EstadoAuditPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the estado auditoria.
     *
     * @param  \App\User  $user
     * @param  \App\EstadoAuditoria  $estadoAuditoria
     * @return mixed
     */
    public function view(User $user, EstadoAuditoria $estadoAuditoria)
    {
        //
    }

    /**
     * Determine whether the user can create estado auditorias.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the estado auditoria.
     *
     * @param  \App\User  $user
     * @param  \App\EstadoAuditoria  $estadoAuditoria
     * @return mixed
     */
    public function update(User $user, EstadoAuditoria $estadoAuditoria)
    {
        //
    }

    /**
     * Determine whether the user can delete the estado auditoria.
     *
     * @param  \App\User  $user
     * @param  \App\EstadoAuditoria  $estadoAuditoria
     * @return mixed
     */
    public function delete(User $user, EstadoAuditoria $estadoAuditoria)
    {
        //
    }

    /**
     * Determine whether the user can restore the estado auditoria.
     *
     * @param  \App\User  $user
     * @param  \App\EstadoAuditoria  $estadoAuditoria
     * @return mixed
     */
    public function restore(User $user, EstadoAuditoria $estadoAuditoria)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the estado auditoria.
     *
     * @param  \App\User  $user
     * @param  \App\EstadoAuditoria  $estadoAuditoria
     * @return mixed
     */
    public function forceDelete(User $user, EstadoAuditoria $estadoAuditoria)
    {
        //
    }
}
