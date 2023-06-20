<?php

namespace Tests;

use App\Models\Client;

class ClientTest extends TestCase
{
    /**
     * /clients [GET]
     */
    public function testShouldReturnAllClients() {

        $this->get("api/clients", []);
        $this->seeStatusCode(200);
        $this->seeJsonStructure([
            '*' => [
                'id',
                'code',
                'name',
                'email',
                'phone',
                'birthdate',
                'address',
                'address_complement',
                'district',
                'zipcode',
                'deleted_at',
                'created_at',
                'updated_at'
            ]            
        ]);
        
    }

    /**
     * /clients/id [GET]
     */
    public function testShouldReturnClient() {

        $client = Client::factory()->createOne();

        $this->get("api/clients/".$client->id, []);
        $this->seeStatusCode(200);
        $this->seeJsonStructure([
            'id',
            'code',
            'name',
            'email',
            'phone',
            'birthdate',
            'address',
            'address_complement',
            'district',
            'zipcode',
            'deleted_at',
            'created_at',
            'updated_at'
        ]);
        
    }

    /**
     * /clients [POST]
     */
    public function testShouldCreateClient() {

        $client = Client::factory()->make();

        $this->post("api/clients", $client->toArray(), []);
        $this->seeStatusCode(201);
        $this->seeJsonStructure([
            'id',
            'code',
            'name',
            'email',
            'phone',
            'birthdate',
            'address',
            'address_complement',
            'district',
            'zipcode',
            'created_at',
            'updated_at'      
        ]);
        
    }
    
    /**
     * /clients/id [PUT]
     */
    public function testShouldUpdateClient() {

        $client = Client::factory()->createOne();

        $this->put("api/clients/" . $client->id, Client::factory()->make()->toArray(), []);
        $this->seeStatusCode(200);
        $this->seeJsonStructure([
            'id',
            'code',
            'name',
            'email',
            'phone',
            'birthdate',
            'address',
            'address_complement',
            'district',
            'zipcode',
            'created_at',
            'updated_at'  
        ]);
    }

    /**
     * /clients/id [DELETE]
     */
    public function testShouldDeleteClient() {
        
        $client = Client::factory()->createOne();

        $this->delete("api/clients/" . $client->id, [], []);
        $this->seeStatusCode(410);
        $this->seeJsonStructure([
            'success'
        ]);
    }

}