<?php

namespace Tests\Unit\Http\Controllers;

use App\Models\VehicleCheck;
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
        $this->assertSame(0, VehicleCheck::count());

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
        $this->assertSame(1, VehicleCheck::count());
    }

    public function test_that_current_odometer_reading_is_required(): void
    {
        $this->assertSame(0, VehicleCheck::count());

        $response = $this->postJson('/check', [
            'current_odometer' => '',
            'previous_date' => '2025-01-01',
            'previous_odometer' => 9000,
        ]);

        $response->assertUnprocessable();
        $response->assertValidationError('current_odometer', 'The current odometer field is required.');
        $this->assertSame(0, VehicleCheck::count());
    }

    public function test_that_current_odometer_reading_must_be_a_valid_integer(): void
    {
        $this->assertSame(0, VehicleCheck::count());

        $response = $this->postJson('/check', [
            'current_odometer' => 'invalid',
            'previous_date' => '2025-01-01',
            'previous_odometer' => 10000,
        ]);

        $response->assertUnprocessable();
        $response->assertValidationError('current_odometer', 'The current odometer must be an integer.');
        $this->assertSame(0, VehicleCheck::count());
    }

    public function test_that_current_odometer_reading_must_be_greater_than_previous_odometer_reading(): void
    {
        $this->assertSame(0, VehicleCheck::count());

        $response = $this->postJson('/check', [
            'current_odometer' => 9000,
            'previous_date' => '2025-01-01',
            'previous_odometer' => 10000,
        ]);

        $response->assertUnprocessable();
        $response->assertValidationError('current_odometer', 'The current odometer must be greater than the previous odometer reading.');
        $this->assertSame(0, VehicleCheck::count());
    }

    public function test_that_previous_date_is_required(): void
    {
        $this->assertSame(0, VehicleCheck::count());

        $response = $this->postJson('/check', [
            'current_odometer' => 10000,
            'previous_date' => '',
            'previous_odometer' => 9000,
        ]);

        $response->assertUnprocessable();
        $response->assertValidationError('previous_date', 'The previous date field is required.');
        $this->assertSame(0, VehicleCheck::count());
    }

    public function test_that_previous_date_must_be_a_valid_date(): void
    {
        $this->assertSame(0, VehicleCheck::count());

        $response = $this->postJson('/check', [
            'current_odometer' => 10000,
            'previous_date' => 'invalid',
            'previous_odometer' => 9000,
        ]);

        $response->assertUnprocessable();
        $response->assertValidationError('previous_date', 'The previous date field must be a valid date.');
        $this->assertSame(0, VehicleCheck::count());
    }

    public function test_that_previous_date_must_be_before_today(): void
    {
        $this->assertSame(0, VehicleCheck::count());

        $response = $this->postJson('/check', [
            'current_odometer' => 10000,
            'previous_date' => now()->addDay()->format('Y-m-d'),
            'previous_odometer' => 9000,
        ]);

        $response->assertUnprocessable();
        $response->assertValidationError('previous_date', 'The previous date field must be a date before today.');
        $this->assertSame(0, VehicleCheck::count());
    }

    public function test_that_previous_odometer_is_required(): void
    {
        $this->assertSame(0, VehicleCheck::count());

        $response = $this->postJson('/check', [
            'current_odometer' => 10000,
            'previous_date' => '2025-01-01',
            'previous_odometer' => '',
        ]);

        $response->assertUnprocessable();
        $response->assertValidationError('previous_odometer', 'The previous odometer field is required.');
        $this->assertSame(0, VehicleCheck::count());
    }

    public function test_that_previous_odometer_must_be_a_valid_integer(): void
    {
        $this->assertSame(0, VehicleCheck::count());

        $response = $this->postJson('/check', [
            'current_odometer' => 10000,
            'previous_date' => '2025-01-01',
            'previous_odometer' => 'invalid',
        ]);

        $response->assertUnprocessable();
        $response->assertValidationError('previous_odometer', 'The previous odometer must be an integer.');
        $this->assertSame(0, VehicleCheck::count());
    }

    public function test_that_previous_odometer_must_be_greater_than_0(): void
    {
        $this->assertSame(0, VehicleCheck::count());

        $response = $this->postJson('/check', [
            'current_odometer' => 10000,
            'previous_date' => '2025-01-01',
            'previous_odometer' => -1,
        ]);

        $response->assertUnprocessable();
        $response->assertValidationError('previous_odometer', 'The previous odometer field must be greater than or equal to 0.');
        $this->assertSame(0, VehicleCheck::count());
    }
}
