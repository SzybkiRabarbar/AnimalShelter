<?php

namespace App\Http\Controllers;

use App\Models\Animal;
use App\Models\Shelter;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class AnimalController extends Controller
{
    public function list(Request $request): View
    {
        $query = Animal::where('is_archived', false);

        $selectedShelterId = $request->input('shelter_id');
        $selectedType = $request->input('type');
        $selectedBreed = $request->input('breed');

        if ($selectedShelterId && $selectedShelterId !== 'all') {
            $query->where('shelter_id', $selectedShelterId);
        }

        $types = $query->distinct()->pluck('type')->toArray();
        $breeds = null;

        if ($selectedType && $selectedType !== 'all') {
            $query->where('type', $selectedType);
            $breeds = $query->distinct()->pluck('breed')->toArray();
        } else {
            $selectedBreed = null;
        }

        if ($selectedBreed && $selectedBreed !== 'all') {
            $query->where('breed', $selectedBreed);
        }

        $animals = $query->get();
        $shelters = Shelter::all();

        return view('animal.list', [
            'animals' => $animals,
            'shelters' => $shelters,
            'selectedShelterId' => $selectedShelterId,
            'types' => $types,
            'selectedType' => $selectedType,
            'breeds' => $breeds,
            'selectedBreed' => $selectedBreed,
        ]);
    }

    public function details(Request $request, string $uuid): View|JsonResponse
    {
        $animal = Animal::where('uuid', $uuid)->with('shelter')->first();

        if (!$animal) {
            return Response::json(['error' => 'Animal not found'], 404);
        }

        return view('animal.details', [
            'animal' => $animal,
            'shelter' => $animal->shelter,
        ]);
    }

    public function edit(Request $request, string $uuid): View|JsonResponse
    {
        $animal = Animal::where('uuid', $uuid)->first();
        $shelters = Shelter::all();

        if (!$animal) {
            return Response::json(['error' => 'Animal not found'], 404);
        }

        return view('animal.edit', [
            'animal' => $animal,
            'shelters' => $shelters,
        ]);
    }

    public function update(Request $request, string $uuid)
    {
        $animal = Animal::where('uuid', $uuid)->firstOrFail();

        $validatedData = $request->validate([
            'type' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'is_male' => 'boolean',
            'breed' => 'nullable|string|max:255',
            'date_of_birth' => 'nullable|date',
            'description' => 'nullable|string',
            'history' => 'nullable|string',
            'likes' => 'nullable|string',
            'dislikes' => 'nullable|string',
            'arrival_date' => 'required|date',
            'is_archived' => 'boolean',
            'archived_date' => 'nullable|date',
            'archive_cause' => 'nullable|string',
            'shelter_id' => 'required|exists:shelters,id',
            'image' => 'nullable|image|mimes:jpeg,jpg|max:2048',
        ]);

        $animal->update($validatedData);

        if ($request->hasFile('image')) {
            $oldImagePath = 'animals/' . $animal->uuid . '.jpg';
            if (Storage::disk('public')->exists($oldImagePath)) {
                Storage::disk('public')->delete($oldImagePath);
            }

            $image = $request->file('image');
            $filename = $animal->uuid . '.jpg';
            Storage::disk('public')->putFileAs('animals', $image, $filename);
        }

        return redirect()->route('animal.details', ['uuid' => $animal->uuid])->with('success', 'Animal updated successfully!');
    }

    public function create(Request $request): View
    {
        $shelters = Shelter::all();
        return view('animal.create', compact('shelters'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'type' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'is_male' => 'boolean',
            'breed' => 'nullable|string|max:255',
            'date_of_birth' => 'nullable|date',
            'description' => 'nullable|string',
            'history' => 'nullable|string',
            'likes' => 'nullable|string',
            'dislikes' => 'nullable|string',
            'arrival_date' => 'required|date',
            'is_archived' => 'boolean',
            'archived_date' => 'nullable|date',
            'archive_cause' => 'nullable|string',
            'shelter_id' => 'required|exists:shelters,id',
            'image' => 'required|image|mimes:jpeg,jpg|max:2048',
        ]);

        $animal = new Animal($validatedData);
        $animal->uuid = (string) Str::uuid();
        $animal->save();

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = $animal->uuid . '.jpg';
            Storage::disk('public')->putFileAs('animals', $image, $filename);
        }

        return redirect()->route('animal.details', ['uuid' => $animal->uuid])->with('success', 'Animal added successfully!');
    }
}
