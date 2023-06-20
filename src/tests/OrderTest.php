<?php

namespace Tests;

use App\Models\Client;
use App\Models\Order;
use App\Models\Product;

class OrderTest extends TestCase
{
    /**
     * /Orders [GET]
     */
    public function testShouldReturnAllOrders() {

        $this->get("api/orders", []);
        $this->seeStatusCode(200);
        $this->seeJsonStructure([
            '*' => [
                'id',
                'client_id',
                'note',
                'deleted_at',
                'created_at',
                'updated_at'
            ]            
        ]);
        
    }

    /**
     * /Orders/id [GET]
     */
    public function testShouldReturnOrder() {

        $client = Client::factory()->createOne();
        $order = Order::factory()->createOne(['client_id' => $client->id]);

        $this->get("api/orders/" . $order->id, []);
        $this->seeStatusCode(200);
        $this->seeJsonStructure([
            'id',
            'client_id',
            'note',
            'deleted_at',
            'created_at',
            'updated_at'
        ]);        
    }

    /**
     * /Orders [POST]
     */
    public function testShouldCreateOrder() {

        $order = Order::factory()->make();

        $this->post("api/orders", $order->toArray(), []);
        $this->seeStatusCode(201);
        $this->seeJsonStructure([
            'id',
            'client_id',
            'note',
            'created_at',
            'updated_at'      
        ]);
        
    }
    
    /**
     * /Orders/id [PUT]
     */
    public function testShouldUpdateOrder() {

        $Order = Order::factory()->createOne();

        $this->put("api/orders/" . $Order->id, Order::factory()->make()->toArray(), []);
        $this->seeStatusCode(200);
        $this->seeJsonStructure([
            'id',
            'client_id',
            'note',
            'created_at',
            'updated_at' 
        ]);
    }

    /**
     * /Orders/id [DELETE]
     */
    public function testShouldDeleteOrder() {
        
        $order = Order::factory()->createOne();

        $this->delete("api/orders/" . $order->id, [], []);
        $this->seeStatusCode(410);
        $this->seeJsonStructure([
            'success'
        ]);
    }

    /**
     * /Orders/id/add-product [POST]
     */
    public function testShouldAddProductToOrder() {

        $order = Order::factory()->createOne();
        $product = Product::factory()->createOne(['photo' => 'img/product/addProductToOrder.png']);

        $this->post('api/orders/' . $order->id . '/add-product', ['product_id' => $product->id]);
        $this->seeStatusCode((201));
        $this->seeJsonStructure(([
            'success'
        ]));
    }

     /**
     * /Orders/id/remove-product [POST]
     */
    public function testShouldRemoveProductFromOrder() {

        $order = Order::factory()->createOne();
        $product = Product::factory()->createOne(['photo' => 'img/product/removeProductFromOrder.png']);

        $this->post('api/orders/' . $order->id . '/remove-product', ['product_id' => $product->id]);
        $this->seeStatusCode((410));
        $this->seeJsonStructure(([
            'success'
        ]));
    }

    /**
     * /Orders/id/send-mail [POST]
     */
    public function testshouldSendMail() {

        $client = Client::factory()->createOne(['email' => 'murilo.dcarmo@gmail.com']);
        $order = Order::factory()->createOne(['client_id' => $client->id]);

        $this->post('api/orders/' . $order->id . '/send-mail');
        $this->seeStatusCode((200));
        $this->seeJsonStructure(([
            'success'
        ]));
    }
}