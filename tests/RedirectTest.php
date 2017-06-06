<?php

namespace Dannymcc\Redirection\Tests;

use Dannymcc\Redirection\Models\Redirect;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class RedirectTest extends BaseTestCase
{
    use DatabaseMigrations;

    /** @test */
    function redirect_is_actioned()
    {
        $this->addRedirect('/from', '/to', 301);

        $response = $this->get('/from');

        $response->assertRedirect('/to');
        $response->assertStatus(301);
    }

    /** @test */
    function redirects_from_domain()
    {
        $this->addRedirect('http://domain.app', '/to', 301);

        $response = $this->get('http://domain.app');

        $response->assertRedirect('/to');
        $response->assertStatus(301);
    }

    /** @test */
    function redirects_to_domain()
    {
        $this->addRedirect('/from', 'http://example.com', 301);

        $response = $this->get('/from');

        $response->assertRedirect('http://example.com');
        $response->assertStatus(301);
    }

    /** @test */
    function redirects_from_root()
    {
        $this->addRedirect('/', '/to/none/root', 301);

        $response = $this->get('/');

        $response->assertRedirect('/to/none/root');
        $response->assertStatus(301);
    }

    /** @test */
    function redirects_with_trailing_slash()
    {
        $this->addRedirect('/', '/with-trailing-slash/', 301);

        $response = $this->get('/');

        $response->assertRedirect('/with-trailing-slash/');
        $response->assertStatus(301);
    }

    /** @test */
    function respects_status_code()
    {
        $this->addRedirect('/from-301', '/to-301', 301);
        $this->addRedirect('/from-302', '/to-302', 302);
        $this->addRedirect('/from-307', '/to-307', 307);

        $response301 = $this->get('/from-301');
        $response302 = $this->get('/from-302');
        $response307 = $this->get('/from-307');

        $response301->assertRedirect('/to-301');
        $response301->assertStatus(301);

        $response302->assertRedirect('/to-302');
        $response302->assertStatus(302);

        $response307->assertRedirect('/to-307');
        $response307->assertStatus(307);
    }

    private function addRedirect($from, $to, $statusCode)
    {
        Redirect::create([
            'from_url'      => $from,
            'to_url'        => $to,
            'status_code'   => $statusCode
        ]);
    }
}