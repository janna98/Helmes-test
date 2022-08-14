<?php

namespace Tests\Feature;

use Illuminate\Support\Facades\Session;
use Tests\TestCase;

class SectorTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testMissingValuesFailure()
    {
        Session::start();
        $response = $this->call('POST', 'submit-form', []);
        $response->assertSessionHasErrors(['name', 'sectors', 'agreement']);
    }

    public function testIncorrectValuesFailure()
    {
        Session::start();
        $data = ['name' => 12, 'sectors' => 'test', 'agreement' => 'test'];
        $response = $this->call('POST', 'submit-form', $data);
        $response->assertSessionHasErrors(
            [
                'name' => 'The name must be a string.',
                'sectors' => 'The sectors must be an array.',
                'agreement' => 'The agreement must be accepted.']
        );
    }

    public function testSubmitSuccessful() {
        Session::start();
        $data = ['name' => 'test', 'sectors' => ['sector_1'], 'agreement' => 1];
        $response = $this->call('POST', 'submit-form', $data);
        $response->assertSessionHasNoErrors();
    }
}
