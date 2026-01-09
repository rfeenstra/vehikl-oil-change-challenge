<?php

namespace Tests\Unit\Http\Controllers;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class VehicleCheckControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_that_guests_can_view_the_vehicle_oil_check_page(): void
    {
        $response = $this->get('/');

        $response->assertOk();
        $response->assertSee('Vehikl Oil Change Challenge');
        $response->assertSee('Current odometer reading:');
        $response->assertSee('Previous oil change date:');
        $response->assertSee('Previous odometer reading:');
    }

    public function test_that_guests_can_store_a_vehicle_oil_check(): void
    {
        $response = $this->post('/check', [
            'current_odometer' => 10000,
            'previous_date' => '2025-01-01',
            'previous_odometer' => 9000,
        ]);

        $response->assertRedirect();
        $this->assertDatabaseHas('vehicle_checks', [
            'current_odometer' => 10000,
            'previous_date' => '2025-01-01 00:00:00',
            'previous_odometer' => 9000,
        ]);
    }
}
