<?php
/**
 * Created by PhpStorm.
 * User: zhaozemin
 * Date: 2018/7/26
 * Time: 15:20
 */

namespace App\Repositories\Contracts;


interface RepositoryInterface
{

    public function all($columns = array('*'));
    public function select($columns = array('*'), $conditions = [], $orderBy = [], $limit);
    public function paginate($columns = array('*'), $conditions = [], $orderBy = [], $perPage = 15);
    public function create(array $data);
    public function update(array $data, $id);
    public function updateBy(array $data, $conditions = []);
    public function delete($id);
    public function find($columns = array('*'), $id);
    public function findBy($columns = array('*'), $conditions = []);
}