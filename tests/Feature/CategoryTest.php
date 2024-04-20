<?php

uses(\Illuminate\Foundation\Testing\RefreshDatabase::class);

beforeEach(function () {
    $this->withoutMiddleware(\App\Http\Middleware\EnsureTokenIsValid::class);
});

it('can list categories', function () {
    $this->getJson('/api/categories')->assertStatus(200);
});

it('can create a category', function () {
    $data = [
        'name' => 'Category 1',
        'description' => 'XXX'
    ];
    // 201 http created
    $this->postJson('/api/categories',$data)->assertStatus(201);
});

it('cant create a category with invalid request', function () {
    $this->postJson('/api/categories', [])->assertStatus(422);
});
