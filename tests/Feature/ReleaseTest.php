<?php

namespace Tests\Feature;

use App\Models\Release;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class ReleaseTest extends TestCase
{
    use RefreshDatabase;
    private $data = [
        'version' => 20,
        'description' => 'First version update',
    ];

    public function test_index_200()
    {
        $response = $this->get(route('releases.index'));

        $response->assertStatus(200);
    }

    public function test_create_guest()
    {
        $response = $this->get(route('releases.create'));

        $response->assertForbidden();
    }

    public function test_create_user()
    {
        $user = User::factory()->create();
        $user = User::factory()->create();
        $response = $this->actingAs($user, 'web')->get(route('releases.create'));

        $response->assertForbidden();
    }

    public function test_create_admin()
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user, 'web')->get(route('releases.create'));

        $response->assertOk();
    }

    // public function test_store_get()
    // {
    //     $this->get(route('releases.store'))->assertNotFound();
    // }

    public function test_store_guest()
    {
        $response = $this->post(route('releases.store'));

        $response->assertForbidden();
    }

    public function test_store_user()
    {
        $user = User::factory()->create();
        $user = User::factory()->create();
        $response = $this->actingAs($user, 'web')->post(route('releases.store'), [
            'version' => 112,
            'description' => 'required',
            'file_inst' => UploadedFile::fake()->create('file2.exe', 2999),
            'file_arc' => UploadedFile::fake()->create('arc2.zip', 2999),
        ]);

        $response->assertForbidden();
    }

    public function addRelease($user = null)
    {
        if ($user == null) {
            $user = User::factory()->create();
        }
        Storage::fake('local');
        $file_inst = UploadedFile::fake()->create('PGInstall-1.exe', 3999);
        $file_arc = UploadedFile::fake()->create('PGArc-1.zip', 3999);
        $response = $this->actingAs($user, 'web')->post(route('releases.store'), [
            'version' => 5,
            'description' => 'First version',
            'file_inst' => $file_inst,
            'file_arc' => $file_arc,
        ]);
        return [$file_inst, $file_arc, $response];
    }

    public function test_store_admin()
    {
        [$file_inst, $file_arc, $response] = $this->addRelease();
        Storage::disk('local')->assertExists('file_inst/' . $file_inst->getClientOriginalName());
        Storage::disk('local')->assertExists('file_arc/' . $file_arc->getClientOriginalName());

        $this->assertTrue($rel = Release::where('version', 5)->count() == 1);
        $this->assertTrue(Release::where('version', 5)->first()->description == 'First version');


        $response->assertRedirect(route('releases.index'));
    }

    public function test_show()
    {
        $this->addRelease();
        $response = $this->get(route('releases.show', 5));
        $response->assertOk()->assertSee('First version');
    }

    public function test_show_bad_version()
    {
        $this->addRelease();
        $response = $this->get(route('releases.show', 10));
        $response->assertNotFound();
    }


    public function test_edit_guest()
    {
        $response = $this->get(route('releases.edit', 5));

        $response->assertForbidden();
    }

    public function test_edit_user()
    {
        $user = User::factory()->create();
        $user = User::factory()->create();
        $response = $this->actingAs($user, 'web')->get(route('releases.edit', 5));

        $response->assertForbidden();
    }

    public function test_edit_admin()
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user, 'web')->get(route('releases.edit', 5));
        $response->assertNotFound();

        [$file_inst, $file_arc, $response] = $this->addRelease($user);
        $response = $this->actingAs($user, 'web')->get(route('releases.edit', 5));
        $response->assertOk();
    }


    public function test_update_get()
    {
        $this->get(route('releases.update', 5))->assertNotFound();
        $this->post(route('releases.update', 5))->assertStatus(405);
    }

    public function test_update_guest()
    {

        $response = $this->put(route('releases.update', 5), $this->data);

        $response->assertForbidden();
    }

    public function test_update_user()
    {
        $user = User::factory()->create();
        $user = User::factory()->create();
        $response = $this->actingAs($user, 'web')->put(route('releases.update', 5));

        $response->assertForbidden();
    }

    public function test_update_admin()
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user, 'web')->put(route('releases.update', 1));
        $response->assertNotFound();

        [$file_inst, $file_arc, $response] = $this->addRelease($user);
        $this->actingAs($user, 'web')->put(route('releases.update', 5), $this->data);
        $this->assertTrue($rel = Release::where('version', 20)->count() == 1);
        $this->assertTrue(Release::where('version', 20)->first()->description == 'First version update');
    }


    public function test_destroy_get()
    {
        $this->get(route('releases.destroy', 5))->assertNotFound();
        $this->post(route('releases.destroy', 5))->assertStatus(405);
    }

    public function test_destroy_guest()
    {
        $response = $this->delete(route('releases.destroy', 5), $this->data);

        $response->assertForbidden();
    }

    public function test_destroy_user()
    {
        $user = User::factory()->create();
        $user = User::factory()->create();
        $response = $this->actingAs($user, 'web')->delete(route('releases.destroy', 5));

        $response->assertForbidden();
    }

    public function test_destroy_admin()
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user, 'web')->delete(route('releases.destroy', 1));
        $response->assertNotFound();

        [$file_inst, $file_arc, $response] = $this->addRelease($user);
        $this->actingAs($user, 'web')->delete(route('releases.destroy', 5))->assertRedirect(route('releases.index'));
        $this->assertTrue($rel = Release::where('version', 5)->count() == 0);
    }
}
