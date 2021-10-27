<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;


    public function test_peoples_request()
    {
        $response = $this->get('/api/peoples/');
        $response->assertStatus(200);
    }

    public function test_peoples_paginate_request()
    {
        $response = $this->get('/api/peoples/10');
        $response->assertStatus(200);
    }

    public function test_peoples_sort_request()
    {
        $response = $this->get('/api/peoples/10/mass/');
        $response->assertStatus(200);
        $response = $this->get('/api/peoples/10/name/Luke');
        $response->assertStatus(200);
    }

    public function test_peoples_search_request()
    {
        $response = $this->get('/api/peoples/10/name/Luke');
        $response->assertStatus(200);
    }


    public function test_people_request()
    {
        $response = $this->get('/api/people/1');
        $response->assertStatus(200);
    }


    public function test_people_failing_request()
    {
        $response = $this->get('/api/people/9999');
        $response->assertStatus(404);
    }
}
