<?php

namespace App\Http\Controllers;

use App\Models\Markings;
use Illuminate\Http\Request;

class MarkingsController extends Controller
{
    public function index()
    {
        return Response()->json(['data' =>  Markings::all()], 200);
    }


    public function show($id)
    {
        $markings = Markings::find($id);

        if (!$markings) {
            return Response()->json(['message' => 'Marking not found'], 404);
        }

        return Response()->json(['data' => $markings], 200);
    }

    public function store(Request $request,)
    {
        if ($request->headers->get("content-type") == "application/json") {
            $data = $request->toArray();
        } else {
            $data = $request->request->all();
        }

        $markings = Markings::firstWhere('name', $data['name']);

        if ($markings) {
            return Response()->json(['message' => 'name already exist'], 409);
        }

        $markings =  Markings::create($data);

        return Response()->json(['message' => 'Marking created success!', 'data' => $markings], 201);
    }


    public function update($id, Request $request, Markings $markings)
    {
        if ($request->headers->get("content-type") == "application/json") {
            $data = $request->toArray();
        } else {
            $data = $request->request->all();
        }

        $markings = Markings::find($id);

        if (!$markings) {
            return Response()->json(['message' => 'Marking not found'], 404);
        }

        $markingsExist = Markings::firstWhere('name', $data['name']);

        if ($markingsExist) {
            return Response()->json(['message' => 'name already exist'], 409);
        }

        $markings->update($data);

        return Response()->json(['message' => 'Marking updated success!', 'data' => $markings], 200);
    }

    public function destroy($id, Markings $markings)
    {
        $markings = Markings::find($id);

        if (!$markings) {
            return Response()->json(['message' => 'Marking not found'], 404);
        }

        $markings->delete($markings);

        return Response()->json([], 204);
    }
}
