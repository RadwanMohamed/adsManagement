<?php

namespace Tests\Feature;

use App\Models\Tag;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TagTest extends TestCase
{
    use RefreshDatabase;
    /** @test */
    public function a_title_is_required(){
        $response =  $response = $this->post("/api/tags",[
            'title' => "",
            "description" => "description"
        ]);;
        $response->assertStatus(422);
        $response->assertSee("title");
    }

    /** @test */
    public function a_description_is_required(){
        $response = $this->post("/api/tags",[
            'title' => "title",
            "description" => ""
        ]);
        $response->assertStatus(422);
        $response->assertSee("description");
    }

   /** @test */
    public function a_tag_can_be_added_to_tags(){
        $response = $this->create();

        $response->assertOk();

        $this->assertCount(1,Tag::all());
    }

    /**@test */
    public function a_tag_can_be_updated(){
        $response = $this->create();
        $tag = Tag::first();

        $this->put("/api/tags/".$tag->id,[
            "title" => "new title",
            "description" => "new description"
        ]);
        $this->assertOk();
        $tag = Tag::first();
        $this->assertEquals("new title",$tag->title);
        $this->assertEquals("new description",$tag->description);
    }

    /**
     * @test
     */
    public function a_tag_can_be_deleted(){
        $response = $this->create();
        $this->assertCount(1,Tag::all());
        $tag = Tag::first();
        $this->delete("/api/tags/".$tag->id);
        $this->assertCount(0,Tag::all());

    }
    private function create(){
        $response = $this->post("/api/tags",[
            'title' => "title",
            "description" => "description"
        ]);
        return $response;
    }

}
