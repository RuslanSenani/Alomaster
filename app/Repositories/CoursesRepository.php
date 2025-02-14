<?php

namespace App\Repositories;

use App\Contracts\ICoursesRepository;
use App\Models\Front\Course;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class CoursesRepository implements ICoursesRepository
{

    private Course $model;

    public function __construct(Course $model)
    {
        $this->model = $model;
    }

    public function all(): Collection
    {
        return $this->model->orderBy('rank', 'asc')->get();
    }

    public function find($id): ?Model
    {
        return $this->model->findOrFail($id);
    }

    public function getModel(): Model
    {
        return $this->model;
    }

    public function create(array $attributes): Model
    {
        return $this->model->create($attributes);
    }

    public function update($id, array $attributes): bool
    {
        $course = $this->model->findOrFail($id);
        return $course->update($attributes);
    }

    public function delete($id): bool
    {
        return $this->model->destroy($id);
    }
}
