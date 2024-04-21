<?php

uses(\Illuminate\Foundation\Testing\RefreshDatabase::class);

beforeEach(function () {
    $this->withoutMiddleware(\App\Http\Middleware\EnsureTokenIsValid::class);
});

it('can list products', function () {
    $product =  \App\Models\Product::factory()->create();
    $this->getJson(route('products.index', ['category_id' => $product->category_id]))
        ->assertStatus(200)
        ->assertJsonCount(1);
});

it('can create a product', function () {

    $category =  \App\Models\Category::factory()->create();
    $product =  \App\Models\Product::factory()->make(
        ['category_id' => $category->id]
    );

    // 201 http created
    $this->postJson(route('products.store'), $product->toArray())->assertStatus(201);
});

it('cant create a product with invalid request', function () {
    $this->postJson(route('products.store'), [])->assertStatus(422);
});

it('cant create a product with invalid category', function () {

    $product =  \App\Models\Product::factory()->make(
        ['category_id' => 9999]
    );

    $this->postJson(route('products.store'), $product->toArray())->assertStatus(422);
});

it('can edit a product', function () {

    $product =  \App\Models\Product::factory()->create();
    $product->name = 'Product name edited';

    $this->putJson(route('products.update', $product), $product->toArray())->assertStatus(200);

    $productEdited = \App\Models\Product::find($product->id);
    expect($productEdited->name)->toBe($product->name);

});

it('can delete a product', function () {

    $product =  \App\Models\Product::factory()->create();
    $this->deleteJson(route('products.destroy', $product))->assertStatus(204);

    \App\Models\Product::findOrFail($product->id);

})->throws(\Illuminate\Database\Eloquent\ModelNotFoundException::class);


it('can find products by ids', function () {

    \App\Models\Product::factory(5)->create();
    $products = \App\Models\Product::pluck('id');

    $this->getJson(route('products.search', ['id' => $products->toArray()]))
        ->assertStatus(200)
        ->assertJsonCount(5);

});

it('cant find products when invalid id', function () {

    \App\Models\Product::factory()->create();

    $this->getJson(route('products.search', ['id' => [999]]))
        ->assertStatus(200)
        ->assertJsonCount(0);

});
