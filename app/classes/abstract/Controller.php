<?php

namespace App\classes\abstract;
use App\classes\abstract\Model;
use http\Env\Response;

abstract class Controller
{
    protected $model;

    public function __construct()
    {

    }

    public function store()
    {
        $data = $_POST;
        if($this->model->create($data)){
            return 'Item created successfully.';
        }
        return 'Item not created.';
    }

    public function show($id)
    {
        $item = $this->model->find($id);
        return $item;
    }

    public function update($id)
    {
        $data = $_POST;
        $this->model->update($id, $data);
        return 'Item updated successfully.';
    }

    public function destroy($id)
    {
        $this->model->delete($id);
        return 'Item deleted successfully.';
    }
}
