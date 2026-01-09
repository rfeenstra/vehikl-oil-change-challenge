@extends('layouts.master')

@section('content')
    <div class="flex flex-col gap-4 rounded-lg border border-gray-200 bg-zinc-100 px-10 py-8">
        <h1 class="text-4xl font-bold">Vehikl Oil Change Challenge</h1>
        <form action="{{ route('check.store') }}" method="POST" class="mt-2">
            @csrf
            <div class="flex flex-col gap-4">
                <div class="form-group">
                    <label for="current_odometer" class="text-md font-medium text-zinc-700">Current odometer reading:</label>
                    <input type="number" name="current_odometer" id="current_odometer" class="rounded border border-zinc-300 bg-white px-2 py-1">
                    @error('current_odometer')
                        <div class="text-red-500">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="previous_date" class="text-md font-medium text-zinc-700">Previous oil change date:</label>
                    <input type="date" name="previous_date" id="previous_date" class="rounded border border-zinc-300 bg-white px-2 py-1">
                    @error('previous_date')
                        <div class="text-red-500">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="previous_odometer" class="text-md font-medium text-zinc-700">Previous odometer reading:</label>
                    <input type="number" name="previous_odometer" id="previous_odometer" class="rounded border border-zinc-300 bg-white px-2 py-1">
                    @error('previous_odometer')
                        <p class="text-red-500">{{ $message }}</p>
                    @enderror
                </div>
                <button type="submit" class="rounded-md bg-blue-500 px-4 py-2 text-white">Submit</button>
            </div>
        </form>
    @endsection
