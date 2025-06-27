<?php

namespace App\Http\Controllers;

use App\Models\Adoption;
use App\Models\Animal;
use App\Models\Shelter;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Carbon\Carbon;

class AdoptionController extends Controller
{

    public function list(Request $request): View
    {
        $adoptions = Adoption::all();

        $user = Auth::user();

        if (!$user->is_admin) {
            $adoptions = $adoptions->where('user_id', $user->id);
        }

        return view('adoption.list', [
            'adoptions' => $adoptions,
        ]);
    }

    public function details(Request $request, string $uuid): View|JsonResponse
    {
        $entity = Adoption::where('uuid', $uuid)->first();

        if (!$entity) {
            return Response::json(['error' => 'Adoption not found'], 404);
        }

        return view('adoption.details', [
            'adoption' => $entity,
        ]);
    }

    /**
     * Handle an incoming adoption request.
     */
    public function create(Request $request): RedirectResponse
    {
        $request->validate([
            'animal_uuid' => ['required', 'exists:animals,uuid'],
        ]);

        $user = Auth::user();

        $animal = Animal::where('uuid', $request->animal_uuid)->firstOrFail();


        $existingAdoption = Adoption::where('user_id', $user->id)
            ->where('animal_id', $animal->id)
            ->first();

        if ($existingAdoption) {
            return redirect()->route('adoption.details', $existingAdoption->uuid)
                ->with('status', 'You have already requested adoption for this animal.');
        }


        $adoption = Adoption::create([
            'uuid' => Str::uuid(),
            'user_id' => $user->id,
            'animal_id' => $animal->id,
            'is_accepted' => false,
            'is_taken' => false,
            'take_date' => null,
        ]);

        return redirect()->route('adoption.details', $adoption->uuid)
            ->with('status', 'Adoption request submitted successfully!');
    }

    /**
     * Accept an adoption request.
     */
    public function accept(Request $request, string $uuid): RedirectResponse
    {
        $adoption = Adoption::where('uuid', $uuid)->firstOrFail();

        if (!Auth::user()->is_admin) {
            abort(403, 'Unauthorized action.');
        }

        $adoption->is_accepted = true;
        $adoption->save();

        return redirect()->route('adoption.details', $adoption->uuid)
            ->with('status', 'Adoption request accepted.');
    }

    /**
     * Unaccept an adoption request.
     */
    public function unaccept(Request $request, string $uuid): RedirectResponse
    {
        $adoption = Adoption::where('uuid', $uuid)->firstOrFail();

        if (!Auth::user()->is_admin) {
            abort(403, 'Unauthorized action.');
        }

        $adoption->is_accepted = false;
        $adoption->save();

        return redirect()->route('adoption.details', $adoption->uuid)
            ->with('status', 'Adoption request unaccepted.');
    }

    /**
     * Mark an adoption as taken.
     */
    public function taken(Request $request, string $uuid): RedirectResponse
    {
        $adoption = Adoption::where('uuid', $uuid)->firstOrFail();

        if (!Auth::user()->is_admin || !$adoption->is_accepted) {
            abort(403, 'Unauthorized action or adoption not yet accepted.');
        }

        $adoption->is_taken = true;
        $adoption->take_date = Carbon::now();
        $adoption->save();

        $animal = $adoption->animal;
        $user = $adoption->user;

        if ($animal) {
            $animal->is_archived = true;
            $animal->archived_date = Carbon::now();
            $animal->archive_cause = "Adopted by User UUID: {$user->uuid} Name: {$user->name}";
            $animal->save();
        }


        return redirect()->route('adoption.details', $adoption->uuid)
            ->with('status', 'Adoption marked as taken.');
    }
}
