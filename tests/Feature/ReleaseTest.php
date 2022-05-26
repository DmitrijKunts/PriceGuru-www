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

    public function test_index_200()
    {
        $this->get(route('releases.index'))->assertStatus(200);
    }

    public function test_create_guest()
    {
        $this->get(route('releases.create'))->assertForbidden();
    }

    public function test_create_user()
    {
        $user = User::factory()->make(['id' => 2]);
        $this->actingAs($user)
            ->get(route('releases.create'))
            ->assertForbidden();
    }

    public function test_create_admin()
    {
        $user = User::factory()->create();
        $this->actingAs($user)
            ->get(route('releases.create'))
            ->assertOk();
    }


    public function test_store_guest()
    {
        $this->post(route('releases.store'))->assertForbidden();
    }

    public function test_store_user()
    {
        User::factory()->create();
        $user = User::factory()->create();
        $r = Release::factory()->definition();
        $response = $this->actingAs($user)->post(route('releases.store'), $r);

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
        $this->get(route('releases.show', 5))
            ->assertOk()
            ->assertSee('First version');
    }

    public function test_show_bad_version()
    {
        $this->addRelease();
        $this->get(route('releases.show', 10))->assertNotFound();
    }


    public function test_edit_guest()
    {
        User::factory()->create();
        $this->get(route('releases.edit', 5))->assertNotFound();

        Release::factory()->create(['version' => 5]);
        $this->get(route('releases.edit', 5))
            ->assertForbidden();
    }

    public function test_edit_user()
    {
        User::factory()->create();
        $user = User::factory()->create();
        Release::factory()->create(['version' => 5]);
        $this->actingAs($user)
            ->get(route('releases.edit', 5))
            ->assertForbidden();
    }

    public function test_edit_admin()
    {
        $user = User::factory()->create();
        $this->actingAs($user)
            ->get(route('releases.edit', 5))
            ->assertNotFound();

        Release::factory()->create(['version' => 5]);
        $this->actingAs($user)
            ->get(route('releases.edit', 5))
            ->assertOk();
    }


    public function test_update_get()
    {
        $this->get(route('releases.update', 5))->assertNotFound();
        $this->post(route('releases.update', 5))->assertStatus(405);
    }

    public function test_update_guest()
    {
        $r = Release::factory()->create(['version' => 5]);
        $this->put(route('releases.update', 5), $r->getAttributes())->assertForbidden();
    }

    public function test_update_user()
    {
        User::factory()->create();
        $user = User::factory()->create();
        Release::factory()->create(['version' => 5]);
        $this->actingAs($user)
            ->put(route('releases.update', 5))
            ->assertForbidden();
    }

    public function test_update_admin()
    {
        $user = User::factory()->create();
        $this->actingAs($user)
            ->put(route('releases.update', 1))
            ->assertNotFound();

        $r = Release::factory()->create(['version' => 5]);
        $d = $r->getAttributes();
        $d['description'] = 'First version update';
        $d['version'] = 20;
        $this->actingAs($user)->put(route('releases.update', 5), $d);
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
        $r = Release::factory()->create(['version' => 5]);
        $this->delete(route('releases.destroy', 5), $r->getAttributes())->assertForbidden();
    }

    public function test_destroy_user()
    {
        User::factory()->create();
        $user = User::factory()->create();
        Release::factory()->create(['version' => 5]);
        $this->actingAs($user)
            ->delete(route('releases.destroy', 5))
            ->assertForbidden();
    }

    public function test_destroy_admin()
    {
        $user = User::factory()->create();
        $this->actingAs($user)
            ->delete(route('releases.destroy', 1))
            ->assertNotFound();

        Release::factory()->create(['version' => 5]);
        $this->actingAs($user)->delete(route('releases.destroy', 5))->assertRedirect(route('releases.index'));
        $this->assertTrue(Release::where('version', 5)->count() == 0);
    }
}
