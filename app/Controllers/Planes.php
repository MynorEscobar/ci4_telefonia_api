<?php

namespace App\Controllers;

use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\RESTful\ResourceController;

class Planes extends ResourceController
{
    protected $modelName = "App\Models\PlanesModel";
    protected $format ="json";
    /**
     * Return an array of resource objects, themselves in array format.
     *
     * @return ResponseInterface
     */
    public function index()
    {
        //método GET muestra todos los registros
        
        //this hace referencia al $modelName
        $planes = $this->model->findAll();
        //retorna todos los productos encontrados en formato indicado en $format
        return $this->respond($planes);

    }

    /**
     * Return the properties of a resource object.
     *
     * @param int|string|null $id
     *
     * @return ResponseInterface
     */
    public function show($id = null)
    {
        //
        $planes=$this->model->find($id);
        if($planes){
            return $this->respond($planes);
        }
        return $this->failNotFound("Producto no encontrado");
    }

    /**
     * Return a new resource object, with default properties.
     *
     * @return ResponseInterface
     */
    public function new()
    {
        //no se necesita, se utiiza para mostrar el formulario para insertar
    }

    /**
     * Create a new resource object, from "posted" parameters.
     *
     * @return ResponseInterface
     */
    public function create()
    {
        //
        $data=$this->request->getJSON(true);
        //print_r($data);
        if($this->model->insert($data)){
            return $this->respondCreated($data,"Datos almacenados");
        }
        return $this->failValidationErrors($this->model->errors());

    }

    /**
     * Return the editable properties of a resource object.
     *
     * @param int|string|null $id
     *
     * @return ResponseInterface
     */
    public function edit($id = null)
    {
        //no se necesita porque se utiliza para mostrar el fomulario de editar
    }

    /**
     * Add or update a model resource, from "posted" properties.
     *
     * @param int|string|null $id
     *
     * @return ResponseInterface
     */
    public function update($id = null)
    {
        //
        $planes=$this->model->find($id);
        if(!$planes){
            return $this->failNotFound('Producto no encontrado');
        }
        $data=$this->request->getJSON(true);
        //print_r($data);
        if($this->model->update($id,$data)){
            return $this->respondUpdated($data,"Datos actualizados");
        }
        //return $this->fail("no se puede actualizar");
        return $this->failValidationErrors($this->model->errors());

    }

    /**
     * Delete the designated resource object from the model.
     *
     * @param int|string|null $id
     *
     * @return ResponseInterface
     */
    public function delete($id = null)
    {
        //
        $planes=$this->model->find($id);
        if($planes){
            $this->model->delete($id);
            return $this->respondDeleted($planes,'Producto no encontrado');
        }
        return $this->failNotFound('Producto no encontrado');
    }
}
