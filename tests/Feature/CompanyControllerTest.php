<?php

namespace Tests\Feature;

use App\Models\Company;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Str;
use Tests\TestCase;

class CompanyControllerTest extends TestCase
{
    private $adminUser;

    public  function setUp(): void
    {
        parent::setUp(); // TODO: Change the autogenerated stub
        $this->adminUser = User::factory()->create(['name' => 'adminTest']);
        $this->actingAs($this->adminUser);
    }
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_company_create()
    {
        $name = Str::random(10);
        $company = Company::factory()->make(['name' => $name]);
        $data = $this->post('/companies/create', $company->toArray());

        $count = Company::all()->where('name', $name)->count();
        $this->assertEquals(1, $count);
    }

    public function test_company_read()
    {
        $company = Company::factory()->create();

        $responseShow = $this->get(route('companies.show', $company->id));
        $responseShow->assertSee($company->name);
        $responseShow->assertSee($company->email);
    }

    public function test_company_edit()
    {
        $company = Company::factory()->create();
        $name = Str::random(10);
        $response = $this->put(route('companies.update', $company->id), [
            'name' => $name,
            'email' => $company->email,
            'website' => $company->website,
        ]);
        $this->assertDatabaseHas('companies',['id'=> $company->id , 'name' => $name]);
    }

    public function test_company_delete()
    {
        $company = Company::factory()->create();
        $response = $this->delete(route('companies.destroy', $company->id));
        $this->assertDatabaseMissing('companies',['id'=> $company->id, 'deleted_at' => null ]);
    }
}
