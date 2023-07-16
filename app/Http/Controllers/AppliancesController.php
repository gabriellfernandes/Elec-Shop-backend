<?php

namespace App\Http\Controllers;

use App\Models\Appliances;
use Illuminate\Http\Request;

class AppliancesController extends Controller
{
    private  $markings;
    private  $voltages;

    public function __construct()
    {
        $this->markings = ['electrolux', 'brastemp', 'fischer', 'samsung', 'lg'];
        $this->voltages = ['110', '127', '220'];
    }

    public function index()
    {
        $appliances =
            Appliances::all();

        return Response()->json($appliances, 200);
    }

    public function show($id)
    {
        $appliances =
            Appliances::find($id);

        if (!$appliances) {
            return Response()->json(['message' => 'appliance not found!'], 404);
        }

        return Response()->json($appliances, 200);
    }

    public function showByName($name)
    {
        $appliances =
            Appliances::where('name', 'like', "%$name%")->get();

        return Response()->json($appliances, 200);
    }

    public function showByMarking($marking)
    {
        $appliances =
            Appliances::where('marking', 'like', "%$marking%")->get();

        return Response()->json($appliances, 200);
    }

    public function store(Request $request)
    {
        if ($request->headers->get("content-type") == "application/json") {
            $data = $request->toArray();
        } else {
            $data = $request->request->all();
        }

        if (!array_key_exists("name", $data)) return Response()->json(['message' => "field name is missing"], 400);
        if (!array_key_exists("description", $data)) return Response()->json(['message' => "field description is missing"], 400);
        if (!array_key_exists("marking", $data)) return Response()->json(['message' => "field marking is missing"], 400);
        if (!array_key_exists("voltage", $data)) return Response()->json(['message' => "field voltage is missing"], 400);

        if (!$this->verifyValue($data['marking'], $this->markings)) {
            return Response()->json(['message' => "Invalid marking value"], 400);
        };

        if (!$this->verifyValue($data['voltage'], $this->voltages)) {
            return Response()->json(['message' => "Invalid voltage value"], 400);
        };

        $appliances = Appliances::firstWhere('name', $data['name']);

        if ($appliances) return Response()->json(['message' => "name already in use"], 409);

        $appliances =
            Appliances::create($data);

        return Response()->json(['message' => 'appliance created success!', 'data' => $appliances], 201);
    }

    public function update(
        $id,
        Request $request,
        Appliances $appliances
    ) {
        if ($request->headers->get("content-type") == "application/json") {
            $data = $request->toArray();
        } else {
            $data = $request->request->all();
        }

        if (array_key_exists("voltage", $data)) {
            if (!$this->verifyValue($data['voltage'], $this->voltages)) {
                return Response()->json(['message' => "Invalid voltage value"], 400);
            };
        }

        if (array_key_exists("marking", $data)) {
            if (!$this->verifyValue($data['marking'], $this->markings)) {
                return Response()->json(['message' => "Invalid marking value"], 400);
            };
        }

        if (array_key_exists("name", $data)) {
            $appliances = Appliances::firstWhere('name', $data['name']);

            if ($appliances && $appliances->id != $id) {
                return Response()->json(['message' => "name already in use"], 409);
            };
        };

        $appliances =
            Appliances::find($id);

        if (!$appliances) {
            return Response()->json(['message' => 'appliance not found!'], 404);
        }

        $appliances->update($data);

        return Response()->json(['message' => 'appliance updated success!', 'data' => $appliances], 200);
    }

    public function destroy(
        $id,
        Appliances $appliances
    ) {
        $appliances =
            Appliances::find($id);
        $appliances->delete($appliances);

        return Response()->json([], 204);
    }

    public function verifyValue($value, $values)
    {
        $valueToCheck = strtolower($value);

        foreach ($values as $item) {
            if (strtolower($item) == $valueToCheck) {
                return true;
            }
        }

        return false;
    }
}
