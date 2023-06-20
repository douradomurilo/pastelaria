<?php

namespace Tests;

use App\Models\Product;
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

        $product = Product::factory()->createOne(['photo' => 'img/product/getproduct.png']);
        
        $this->get("api/products/" . $product->id, []);
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

        $product = Product::factory()->make();

        $this->post("api/products", $product->toArray(), []);
        $this->seeStatusCode(201);
        $this->seeJsonStructure([
            'id',
            'code',
            'name',
            'photo',
            'price',
            'type',
            'created_at',
            'updated_at'
        ]);
        
    }
    
    /**
     * /products/id [PUT]
     */
    public function testShouldUpdateProduct() {

        $product = Product::factory()->createOne(['photo' => 'img/product/updateproduct.png']);

        $this->put("api/products/" . $product->id, Product::factory()->make()->toArray(), []);
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
     * /products/id [DELETE]
     */
    public function testShouldDeleteProduct(){

        $product = Product::factory()->createOne(['photo' => 'img/product/deleteproduct.png']);
        
        $this->delete("api/products/" . $product->id, [], []);
        $this->seeStatusCode(410);
        $this->seeJsonStructure([
            'success'
        ]);
    }

}