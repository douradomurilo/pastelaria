<?php

namespace Tests;
use Illuminate\Http\UploadedFile;

class ProductTest extends TestCase
{
    /**
     * /products [GET]
     */
    public function testShouldReturnAllProducts() {

        $this->get("api/products", []);
        $this->seeStatusCode(200);
        $this->seeJsonStructure([
            '*' => [
                'id',
                'code',
                'name',
                'photo',
                'price',
                'type',
                'deleted_at',
                'created_at',
                'updated_at'
            ]            
        ]);
        
    }

    /**
     * /products/id [GET]
     */
    public function testShouldReturnProduct() {
        $this->get("api/products/6", []);
        $this->seeStatusCode(200);
        $this->seeJsonStructure([
            'id',
            'code',
            'name',
            'photo',
            'price',
            'type',
            'deleted_at',
            'created_at',
            'updated_at'
        ]);
        
    }

    /**
     * /products [POST]
     */
    public function testShouldCreateProduct() {

        $parameters = [
            'code' => 'PASQUEIJ',
            'name' => 'Pastel de Queijo',
            'photo' => new UploadedFile('img/products/', 'queijo.png'),
            'price' => 10.9,
            'type' => 'pasteis'
        ];

        $this->post("api/products", $parameters, []);
        $this->seeStatusCode(200);
        $this->seeJsonStructure([
            '*' => [
                'id',
                'code',
                'name',
                'photo',
                'price',
                'type',
                'deleted_at',
                'created_at',
                'updated_at'
            ]            
        ]);
        
    }
    
    /**
     * /products/id [PUT]
     */
    public function testShouldUpdateProduct() {

        $parameters = [
            'name' => 'Pastel de Carne',
            'photo' => 'img/products/queijo.png',
            'price' => 10.9,
            'type' => 'pasteis'
        ];

        $this->put("api/products/6", $parameters, []);
        $this->seeStatusCode(200);
        $this->seeJsonStructure([
            '*' => [
                'id',
                'code',
                'name',
                'photo',
                'price',
                'type',
                'deleted_at',
                'created_at',
                'updated_at'
            ]
        ]);
    }

    /**
     * /products/id [DELETE]
     */
    public function testShouldDeleteProduct(){
        
        $this->delete("api/products/6", [], []);
        $this->seeStatusCode(410);
        $this->seeJsonStructure([
            'Produto removido com sucesso'
        ]);
    }

}