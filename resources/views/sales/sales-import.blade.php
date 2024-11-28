@extends('layouts.app')

@section('title', 'Import Sales')

@section('content')
<div class="max-w-md mx-auto bg-white p-6 rounded shadow">
    <h1 class="text-xl font-bold mb-4">Import Sales</h1>

    <form action="{{ route('sales.import') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-4">
            <label for="file" class="block text-sm font-bold mb-2">Choose CSV File</label>
            <input type="file" name="file" id="file" class="w-full border-gray-300 rounded">
        </div>

        <div class="flex justify-end">
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Import</button>
        </div>
    </form>
</div>
@endsection
