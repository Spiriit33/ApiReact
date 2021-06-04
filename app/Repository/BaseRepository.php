<?php


namespace App\Repository;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class BaseRepository implements BaseRepositoryInterface
{
    /** @var Model */
    protected Model $model;

    /**
     * BaseRepository constructor.
     * @param Model $model
     */
    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    /**
     * @return Collection
     */
    public function getAll(): Collection
    {
        return $this->model->all();
    }

    /**
     * @param int $id
     * @param array|string[] $attributes
     * @return Model|null
     */
    public function findOne(int $id, array $attributes = ['*']): ?Model
    {
        return $this->model->find($id, $attributes);
    }

    /**
     * @param string $column
     * @param array|string[] $attributes
     * @return Model|null
     */
    public function findBy(array $column, array $attributes = ['*']): ?Model
    {
        return $this->model->where($column)->first($attributes);
    }

    public function create(array $attributes): Model
    {
        return $this->model->create($attributes);
    }

    /**
     * @param int $id
     * @param array $attributes
     */
    public function update(int $id, array $attributes): void
    {
        $this->model->find($id)->update($attributes);
    }

    /**
     * @param int $id
     */
    public function delete(int $id): void
    {
        $this->model->find($id)->delete();
    }
}
