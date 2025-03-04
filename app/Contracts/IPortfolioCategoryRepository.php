<?php

namespace App\Contracts;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

interface IPortfolioCategoryRepository
{
    public function all(array $where, array $order): Collection;

    public function find($id): ?Model;

    public function getModel(): Model;

    public function create(array $attributes): Model;

    public function update($id, array $attributes): bool;

    public function delete($id): bool;
}
