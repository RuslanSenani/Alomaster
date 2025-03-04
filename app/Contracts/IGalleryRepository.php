<?php

namespace App\Contracts;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

interface IGalleryRepository
{
    public function all(): Collection;

    public function find($id): ?Model;

    public function getModel(): Model;

    public function create(array $attributes): Model;

    public function update(array $where, array $attributes): bool;

    public function delete($id): bool;

}
