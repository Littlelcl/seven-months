<?php
/**
 * Created by PhpStorm.
 * User: zhaozemin
 * Date: 2018/7/26
 * Time: 15:25
 */

namespace App\Repositories;

use App\Repositories\Contracts\RepositoryInterface;
use Illuminate\Database\Eloquent\Model;
use App\Exceptions\RepositoryException;

abstract class BaseRepository implements RepositoryInterface
{
    private $app;

    protected  $model;

    public function __construct()
    {
        $this->makeModel();
    }

    abstract function model();

    protected function makeModel()
    {
        $model = app($this->model());

        if (!$model instanceof Model)
            throw new RepositoryException("Class {$this->model()} must be an instance of Illuminate\\Database\\Eloquent\\Model");

        return $this->model = $model;
    }

    public function all($columns = array('*'))
    {
        return $this->model->select($columns)->all();
    }

    public function select($columns = array('*'), $conditions = [], $orderBy = [], $limit)
    {
        $model = $this->model;
        foreach ($conditions as $key => $condition)
        {
            if (is_array($condition))
            {
                $model->whereIn($key, $condition);
            } else {
                $model->whereIn($key, $condition);
            }
        }
        $model->sortBy($orderBy);
        $model->limitBy($limit);
        return $this->model->select($columns)->get();
    }

    public function paginate($columns = array('*'), $conditions = [], $orderBy = [], $perPage = 15)
    {
        $model = $this->model;
        foreach ($conditions as $key => $condition)
        {
            if (is_array($condition))
            {
                $model->whereIn($key, $condition);
            } else {
                $model->whereIn($key, $condition);
            }
        }
        $model->sortBy($orderBy);
        $model->limit($perPage);
        return $this->model->select($columns)->get();
    }

    public function create(array $data)
    {
        return $this->model->create($data);
    }

    public function update(array $data, $id)
    {
        return $this->model->where($this->primaryKey, $id)->update($data);
    }

    public function updateBy(array $data, $conditions = [])
    {
        $model = $this->model;
        foreach ($conditions as $key => $condition)
        {
            if (is_array($condition))
            {
                $model->whereIn($key, $condition);
            } else {
                $model->whereIn($key, $condition);
            }
        }
        return $model->update($data);
    }

    public function delete($id)
    {
        return $this->model->destroy($id);
    }

    public function find($columns = array('*'), $id)
    {
        return $this->model->select($columns)->findOrFail($id);
    }

    public function findBy($columns = array('*'), $conditions = [])
    {
        $model = $this->model;
        foreach ($conditions as $key => $condition)
        {
            if (is_array($condition))
            {
                $model->whereIn($key, $condition);
            } else {
                $model->whereIn($key, $condition);
            }
        }
        return $model->select($columns)->first();
    }

}