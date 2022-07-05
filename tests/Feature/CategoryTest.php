<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class CategoryTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * @test
     */
    public function it_can_access_category_list()
    {
        $user = User::factory()->create();
        $this->actingAs($user, 'api');
        $this->get(route('category.list'))->assertOk()->assertSuccessful();
    }

    /**
     * @test
     */
    public function it_can_access_index()
    {
        $user = User::factory()->create();
        $this->actingAs($user, 'api');
        $this->get(route('category.index'))->assertOk()->assertSuccessful();
    }

    /**
     * @test
     */
    public function it_can_store_category()
    {
        $user = User::factory()->create();
        $this->actingAs($user, 'api');
        $this->post(route('category.store'))->assertOk()->assertSuccessful();
    }
}
