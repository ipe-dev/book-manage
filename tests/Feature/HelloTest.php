<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class HelloTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testExample()
    {
        // 
        $response = $this->get('/');
        $response->assertStatus(200);

        // 一覧画面にアクセスし、ログイン画面に遷移する
        $response = $this->get('/book/list');
        $response->assertStatus(302);

        // ユーザーを作成する
        $user = factory(User::class)->create();

        
        $response = $this->get('/book/detail/1');
        $response->assertStatus(200);
    }
}
