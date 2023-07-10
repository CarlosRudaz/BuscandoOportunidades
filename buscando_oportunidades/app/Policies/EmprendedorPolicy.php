<?php

namespace App\Policies;

use App\Models\Emprendedor;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class EmprendedorPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {

    }

    public function view(User $user, Emprendedor $emprendedor): bool
    {
    }

    public function create(User $user): bool
    {
    }

    public function update(User $user, Emprendedor $emprendedor): bool
    {
    }

    public function delete(User $user, Emprendedor $emprendedor): bool
    {
    }

    public function restore(User $user, Emprendedor $emprendedor): bool
    {
    }

    public function forceDelete(User $user, Emprendedor $emprendedor): bool
    {
    }
}
