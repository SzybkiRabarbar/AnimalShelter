<?php

namespace App\Http\Controllers;

use App\Models\Shelter;
use Illuminate\View\View;
use Illuminate\Support\Str;
use App\Models\Volunteering;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Response;

class VolunteeringController extends Controller
{
    public function list(Request $request): View
    {
        $volunteeringRecords = Volunteering::with(['user', 'shelter'])->get();

        $user = Auth::user();

        if (!$user->is_admin) {
            $volunteeringRecords = $volunteeringRecords->where('user_id', $user->id);
        }

        return view('volunteering.list', [
            'volunteeringRecords' => $volunteeringRecords,
        ]);
    }

    public function details(Request $request, string $uuid): View|JsonResponse
    {
        $entity = Volunteering::with(['user', 'shelter'])->where('uuid', $uuid)->first();

        if (!$entity) {
            return Response::json(['error' => 'Volunteering not found'], 404);
        }

        return view('volunteering.details', [
            'volunteering' => $entity,
        ]);
    }

    /**
     * Handle an incoming volunteering request.
     */
    public function create(Request $request): RedirectResponse
    {
        $request->validate([
            'shelter_uuid' => ['required', 'exists:shelters,uuid'],
            'volunteer_date' => ['required'],
        ]);

        $user = Auth::user();

        $shelter = Shelter::where('uuid', $request->shelter_uuid)->firstOrFail();


        $existingVolunteering = Volunteering::where('user_id', $user->id)
            ->where('shelter_id', $shelter->id)
            ->where('volunteer_date', $request->volunteer_date)
            ->first();

        if ($existingVolunteering) {
            return redirect()->route('volunteering.details', $existingVolunteering->uuid)
                ->with('status', 'You have already requested volunteering for this shelter.');
        }


        $volunteering = Volunteering::create([
            'uuid' => Str::uuid(),
            'user_id' => $user->id,
            'shelter_id' => $shelter->id,
            'volunteer_date' => $request->volunteer_date,
            'is_accepted' => false,
            'took_place' => false,
        ]);

        return redirect()->route('volunteering.details', $volunteering->uuid)
            ->with('status', 'Volunteering request submitted successfully!');
    }

    /**
     * Accept an volunteering request.
     */
    public function accept(Request $request, string $uuid): RedirectResponse
    {
        $volunteering = Volunteering::where('uuid', $uuid)->firstOrFail();

        if (!Auth::user()->is_admin) {
            abort(403, 'Unauthorized action.');
        }

        $volunteering->is_accepted = true;
        $volunteering->save();

        return redirect()->route('volunteering.details', $volunteering->uuid)
            ->with('status', 'Volunteering request accepted.');
    }

    /**
     * Unaccept an volunteering request.
     */
    public function unaccept(Request $request, string $uuid): RedirectResponse
    {
        $volunteering = Volunteering::where('uuid', $uuid)->firstOrFail();

        if (!Auth::user()->is_admin) {
            abort(403, 'Unauthorized action.');
        }

        $volunteering->is_accepted = false;
        $volunteering->save();

        return redirect()->route('volunteering.details', $volunteering->uuid)
            ->with('status', 'Volunteering request unaccepted.');
    }

    /**
     * Mark an volunteering as taken.
     */
    public function tookPlace(Request $request, string $uuid): RedirectResponse
    {
        $volunteering = Volunteering::where('uuid', $uuid)->firstOrFail();

        if (!Auth::user()->is_admin || !$volunteering->is_accepted) {
            abort(403, 'Unauthorized action or volunteering not yet accepted.');
        }

        $volunteering->took_place = true;
        $volunteering->save();

        return redirect()->route('volunteering.details', $volunteering->uuid)
            ->with('status', 'Volunteering marked as taken.');
    }
}
