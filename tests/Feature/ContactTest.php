<?php

namespace Tests\Feature;

use App\Http\Livewire\Contact;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Mail;
use Livewire\Livewire;
use Tests\TestCase;

class ContactTest extends TestCase
{

    public function test_contact_can_be_rendered()
    {
        $response = $this->get(route('contact'));

        $response->assertStatus(200);
    }

    function test_contact_contains_livewire_component()
    {
        $this->get(route('contact'))->assertSeeLivewire('contact');
    }

    function test_rulles_livewire_component()
    {
        $data = [
            'subject' => 'S',
            'name' => 'J',
            'email' => 'johnfox@exam@ple.com',
            'content' => 'Q',
        ];
        Livewire::test(Contact::class, $data)
            ->call('submit')
            ->assertHasErrors(['subject', 'name', 'email', 'content']);
    }

    function test_submit_livewire_component()
    {
        $data = [
            'subject' => 'Subject',
            'name' => 'John Fox',
            'email' => 'johnfox@example.com',
            'content' => 'Questions more!',
        ];
        Livewire::test(Contact::class, $data)
            ->call('submit')
            ->assertSeeHtml('Ваше сообщение отправлено');
    }
}
