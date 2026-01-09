@extends('layouts.master')

@section('content')
    <div class="flex flex-col gap-4">
        <div class="flex flex-col gap-4 rounded-lg border border-gray-200 bg-zinc-100 px-10 py-8">
            <h1 class="text-4xl font-bold">Result</h1>
            <p>{{ $check->oilChangeIsDue() ? 'An oil change is needed.' : 'No oil change needed at this time.' }}</p>
            <p>Current odometer reading: {{ $check->current_odometer }}</p>
            <p>Previous oil change was: {{ $check->previous_date?->diffForHumans() }}</p>
            <p>Previous odometer reading: {{ $check->previous_odometer }}</p>
        </div>
        <a href="{{ route('check.create') }}" class="rounded-md bg-blue-500 px-4 py-2 text-center text-white hover:bg-blue-600">Check
            another vehicle</a>
    </div>
@endsection
