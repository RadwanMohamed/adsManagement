<?php

namespace Tests\Feature;

use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CategoryTest extends TestCase
{
    use RefreshDatabase;
    /** @test */
    public function a_title_is_required(){
        $response =  $response = $this->post("/api/categories",[
            'title' => "",
            "description" => "description"
        ]);;
        $response->assertStatus(422);
        $response->assertSee("title");
    }

    /** @test */
    public function a_description_is_required(){
        $response = $this->post("/api/categories",[
            'title' => "title",
            "description" => ""
        ]);
        $response->assertStatus(422);
        $response->assertSee("description");
    }

    /** @test */
    public function a_Category_can_be_added_to_categories(){
        $response = $this->create();

        $response->assertOk();

        $this->assertCount(1,Category::all());
    }

    /**
     * @test
     */
    public function a_Category_can_be_updated(){

        $response = $this->create();
        $Category = Category::first();

        $this->put("/api/categories/".$Category->id,[
            "title" => "new title",
            "description" => "new description"
        ]);
        $Category = Category::first();
        $this->assertEquals("new title",$Category->title);
        $this->assertEquals("new description",$Category->description);
    }

    /**
     * @test
     */
    public function a_Category_can_be_deleted(){
        $response = $this->create();
        $this->assertCount(1,Category::all());
        $Category = Category::first();
        $this->delete("/api/categories/".$Category->id);
        $this->assertCount(0,Category::all());
    }
    private function create(){
        $response = $this->post("/api/categories",[
            'title' => "title",
            "description" => "description"
        ]);
        return $response;
    }

}
