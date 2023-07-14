<?php

namespace App\Http\Controllers;

use App\Models\DomesticAppliances;
use Illuminate\Http\Request;

class DomesticAppliancesController extends Controller
{

    public function index()
    {
        $domestic_appliances = DomesticAppliances::all()->load('marking');

        return Response()->json(['data' => $domestic_appliances], 200);
    }

    public function show($id)
    {
        $domestic_appliances = DomesticAppliances::find($id);

        if (!$domestic_appliances) {
            return Response()->json(['message' => 'Domestic appliance not found'], 404);
        }

        return Response()->json(['data' => $domestic_appliances->load('marking')], 200);
    }

    public function store(Request $request)
    {
        if ($request->headers->get("content-type") == "application/json") {
            $data = $request->toArray();
        } else {
            $data = $request->request->all();
        }

        $domestic_appliances = DomesticAppliances::create($data);

        return Response()->json(['message' => 'Domestic appliance created success!', 'data' => $domestic_appliances->load('marking')], 201);
    }


    public function update($id, Request $request, DomesticAppliances $domestic_appliances)
    {
        if ($request->headers->get("content-type") == "application/json") {
            $data = $request->toArray();
        } else {
            $data = $request->request->all();
        }

        $domestic_appliances = DomesticAppliances::find($id);

        if (!$domestic_appliances) {
            return Response()->json(['message' => 'Domestic appliance not found'], 404);
        }

        $domestic_appliances->update($data);

        return Response()->json(['message' => 'author updated success!', 'data' => $domestic_appliances->load('marking')], 200);
    }

    public function destroy($id, DomesticAppliances $domestic_appliances)
    {
        $domestic_appliances = DomesticAppliances::find($id);
        $domestic_appliances->delete($domestic_appliances);

        return Response()->json([], 204);
    }
}
