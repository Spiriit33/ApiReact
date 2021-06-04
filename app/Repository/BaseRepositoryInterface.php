<?php


namespace App\Repository;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use PhpParser\Node\Expr\AssignOp\Mod;

interface BaseRepositoryInterface
{
    public function getAll() : Collection;

    public function findOne(int $id,array $attributes = ['*']) : ?Model;

    public function findBy(array $column,array $attributes = ['*']) : ?Model;

    public function create(array $attributes) : Model;

    public function update(int $id, array $attributes) : void;

    public function delete(int $id) : void;
}
