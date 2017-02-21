<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class CrudTest extends TestCase
{

    /**
     * Test product creation when category exists.
     *
     */
    
    public function test_store(){
        $this->json('POST', '/product', ['category_id' => '1','product_name' => 'product1', 'product_price' => '20'])
            ->seeJson([
                'success' => true,
            ]);
    }


    /**
     * Test product creation when category does not exist.
     *
     */


    public function test_store2(){
        $this->json('POST', '/product', ['category_id' => '3','product_name' => 'product1', 'product_price' => '20'])
            ->seeJson([
                'success' => false,
            ]);
    }



    /**
     * Test show product with id 1.
     *
     */

    public function test_show(){
        $this->json('GET', '/product/1')
            ->seeJson([
                'success' => true,
            ]);
    }


    /**
     * Test update product with id 1.
     *
     */

    public function test_update(){
        $this->json('POST', '/product/1', ['category_id' => '1','product_name' => 'testupdate', 'product_price' => '1'])
            ->seeJson([
                'success' => true,
            ]);
    }




    /**
     * Test delete product with id 3.
     *
     */


    public function test_delete(){
        $this->json('DELETE', '/product/3')
            ->seeJson([
                'success' => true,
            ]);
    }
}
