<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Models\VehicleCheck;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class VehicleCheckController extends Controller
{
    public function create(): View
    {
        return view('check.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $check = VehicleCheck::create($request->validate([
            'current_odometer' => ['required', 'integer', 'gte:previous_odometer'],
            'previous_date' => ['required', 'date', 'before:today'],
            'previous_odometer' => ['required', 'integer', 'gte:0'],
        ]));

        return Redirect::route('check.show', $check);
    }
}
