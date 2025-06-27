<?php

namespace App\Http\Controllers;

use App\Models\Shelter;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;

class ShelterController extends Controller
{

    public function list(Request $request): View
    {
        $shelters = Shelter::all();

        return view('shelter.list', [
            'shelters' => $shelters
        ]);
    }

    public function details(Request $request, string $uuid): View|JsonResponse
    {
        $entity = Shelter::where('uuid', $uuid)->first();

        if (!$entity) {
            return Response::json(['error' => 'Animal not found'], 404);
        }

        return view('shelter.details', [
            'shelter' => $entity,
        ]);
    }
}
