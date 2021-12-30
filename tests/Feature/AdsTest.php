<?php

namespace Tests\Feature;

use App\Models\Ads;
use App\Models\Category;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdsTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_title_is_required(){
        $default =[
            'title' =>  "" ,
            "description" =>  "description",
            'advertiser_id' =>  $this->getAdvId(),
            'start_date' => "1996-06-10",
            'type' => "free",
            'category_id' => $this->getCategoryId(),
            "tags" => [$this->getTagId()]
        ];
        $response =  $this->create($default);
        $response->assertStatus(422);
        $response->assertSee("title");
    }

    /** @test */
    public function a_description_is_required(){
        $default =[
            'title' =>  "title" ,
            "description" =>  "",
            'advertiser_id' =>  $this->getAdvId(),
            'start_date' => "1996-06-10",
            'type' => "free",
            'category_id' => $this->getCategoryId(),
            "tags" => [$this->getTagId()]
        ];
        $response =  $this->create($default);
        $response->assertStatus(422);
        $response->assertSee("description");
    }


    /** @test */
    public function a_advertiser_id_is_required(){
        $default =[
            'title' =>  "title" ,
            "description" =>  "description",
            'advertiser_id' =>  null,
            'start_date' => "1996-06-10",
            'type' => "free",
            'category_id' => $this->getCategoryId(),
            "tags" => [$this->getTagId()]
        ];
        $response =  $this->create($default);
        $response->assertStatus(422);
        $response->assertSee("advertiser");
    }

    /** @test */
    public function a_advertiser_id_is_valid(){
        $default =[
            'title' =>  "title" ,
            "description" =>  "description",
            'advertiser_id' =>  1000,
            'start_date' => "1996-06-10",
            'type' => "free",
            'category_id' => $this->getCategoryId(),
            "tags" => [$this->getTagId()]
        ];
        $response =  $this->create($default);
        $response->assertStatus(422);
        $response->assertSee("advertiser");
    }
    /** @test */
    public function a_start_date_is_required(){
        $default =[
            'title' =>  "title" ,
            "description" =>  "description",
            'advertiser_id' =>  $this->getAdvId(),
            'start_date' => "",
            'type' => "free",
            'category_id' => $this->getCategoryId(),
            "tags" => [$this->getTagId()]
        ];
        $response =  $this->create($default);
        $response->assertStatus(422);
        $response->assertSee("start date");
    }
    /** @test */
    public function a_start_date_is_a_valid_format(){
        $default =[
            'title' =>  "title" ,
            "description" =>  "description",
            'advertiser_id' =>  $this->getAdvId(),
            'start_date' => "96-06/10",
            'type' => "free",
            'category_id' => $this->getCategoryId(),
            "tags" => [$this->getTagId()]
        ];
        $response =  $this->create($default);
        $response->assertStatus(422);
        $response->assertSee("start date");
    }
    /** @test */
    public function a_type_is_required(){
        $default =[
            'title' =>  "title" ,
            "description" =>  "description",
            'advertiser_id' =>  $this->getAdvId(),
            'start_date' => "1996-06-10",
            'type' => "",
            'category_id' => $this->getCategoryId(),
            "tags" => [$this->getTagId()]
        ];
        $response =  $this->create($default);
        $response->assertStatus(422);
        $response->assertSee("type");
    }
    /** @test */
    public function a_type_is_valid(){
        $default =[
            'title' =>  "title" ,
            "description" =>  "description",
            'advertiser_id' =>  $this->getAdvId(),
            'start_date' => "1996-06-10",
            'type' => "fff",
            'category_id' => $this->getCategoryId(),
            "tags" => [$this->getTagId()]
        ];
        $response =  $this->create($default);
        $response->assertStatus(422);
        $response->assertSee("type");
    }
    /** @test */
    public function a_category_id_required(){
        $default =[
            'title' =>  "title" ,
            "description" =>  "description",
            'advertiser_id' =>  $this->getAdvId(),
            'start_date' => "1996-06-10",
            'type' => "free",
            'category_id' => null,
            "tags" => [$this->getTagId()]
        ];
        $response =  $this->create($default);
        $response->assertStatus(422);
        $response->assertSee("category id");
    }
    /** @test */
    public function a_category_id_is_valid(){
        $default =[
            'title' =>  "title" ,
            "description" =>  "description",
            'advertiser_id' =>  $this->getAdvId(),
            'start_date' => "1996-06-10",
            'type' => "free",
            'category_id' => 1000,
            "tags" => [$this->getTagId()]
        ];
        $response =  $this->create($default);
        $response->assertStatus(422);
        $response->assertSee("category id");
    }
    /** @test */
    public function a_tags_is_required(){
        $default =[
            'title' =>  "title" ,
            "description" =>  "description",
            'advertiser_id' =>  $this->getAdvId(),
            'start_date' => "1996-06-10",
            'type' => "free",
            'category_id' => $this->getCategoryId(),
            "tags" => null
        ];
        $response =  $this->create($default);
        $response->assertStatus(422);
        $response->assertSee("tags");
    }
     /** @test */
    public function a_tags_is_an_array(){
        $default =[
            'title' =>  "title" ,
            "description" =>  "description",
            'advertiser_id' =>  $this->getAdvId(),
            'start_date' => "1996-06-10",
            'type' => "free",
            'category_id' => $this->getCategoryId(),
            "tags" => 10
        ];
        $response =  $this->create($default);
        $response->assertStatus(422);
        $response->assertSee("tags");
    }
    /** @test */
    public function a_tags_is_an_array_of_integers(){
        $default =[
            'title' =>  "title" ,
            "description" =>  "description",
            'advertiser_id' =>  $this->getAdvId(),
            'start_date' => "1996-06-10",
            'type' => "free",
            'category_id' => $this->getCategoryId(),
            "tags" => ["f"]
        ];
        $response =  $this->create($default);
        $response->assertStatus(422);
        $response->assertSee("tags");
    }


    /** @test */
    public function a_ads_can_be_added_to_ads(){
        $default =[
            'title' =>  "title" ,
            "description" =>  "description",
            'advertiser_id' =>  $this->getAdvId(),
            'start_date' => "1996-06-10",
            'type' => "free",
            'category_id' => $this->getCategoryId(),
            "tags" => [$this->getTagId()]
        ];
        $response =  $this->create($default);
        $response->assertOk();
        $this->assertCount(1,Ads::all());
    }

    /**
     * @test
     */
    public function a_ads_can_be_updated(){
        $default =[
            'title' =>  "title" ,
            "description" =>  "description",
            'advertiser_id' =>  $this->getAdvId(),
            'start_date' => "1996-06-10",
            'type' => "free",
            'category_id' => $this->getCategoryId(),
            "tags" => [$this->getTagId()]
        ];
        $response =  $this->create($default);
        $ads = Ads::first();
        $this->put("/api/ads/".$ads->id,[
            'title' =>  "new title" ,
            "description" =>  "new description",
        ]);
        $ads = Ads::first();
        $response->assertOk();
        $this->assertEquals("new title",$ads->title);
        $this->assertEquals("new description",$ads->description);
    }
    /**
     * @test
     */
    public function a_ads_can_be_deleted(){
        $default =[
            'title' =>  "title" ,
            "description" =>  "description",
            'advertiser_id' =>  $this->getAdvId(),
            'start_date' => "1996-06-10",
            'type' => "free",
            'category_id' => $this->getCategoryId(),
            "tags" => [$this->getTagId()]
        ];
        $response =  $this->create($default);
        $this->assertCount(1,Ads::all());
        $ads = Ads::first();
        $this->delete("/api/ads/".$ads->id);
        $this->assertCount(0,Ads::all());
    }

    /**
     * seed ads to complete test process
     * @return mixed
     */
    private function create($data=[]){
        $response = $this->post("/api/ads",$data);
        return $response;
    }

    /**
     * seed advertiser to complete test process
     * @return mixed
     */
    private function getAdvId(){
        User::factory()->count(1)->create();
        return (User::first())->id;
    }

    /**
     * seed category to complete test process
     * @return mixed
     */
    private function getCategoryId(){
        Category::factory()->count(1)->create();
        return (Category::first())->id;
    }

    /**
     * seed tag to complete test process
     * @return mixed
     */
    private function getTagId(){
        Tag::factory()->count(1)->create();
        return (Tag::first())->id;
    }
}
