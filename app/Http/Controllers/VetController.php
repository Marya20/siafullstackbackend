<?php

namespace App\Http\Controllers;

use App\Models\Vet;
use Exception;
use Illuminate\Http\Request;

class VetController extends Controller
{
    public function show(Vet $vet) {
        return response()->json($vet,200);
    }

    public function search(Request $request) {
        $request->validate(['key'=>'string|required']);

        $vets = Vet::where('name','like',"%$request->key%")
            ->orWhere('pet','like',"%$request->key%")->get();

        return response()->json($songs, 200);
    }

    public function store(Request $request) {
        $request->validate([
            'name' => 'string|required',
            'pet' => 'string|required',
            'gender' => 'string|required',
            'breed' => 'string|required',
            'vaccine' => 'string|required',
            'date' => 'date|required',
         
        ]);

        try {
            $vet = Vet::create([

                'name' => $request->name,
                'pet' => $request->pet,
                'gender' => $request->gender,
                'breed' => $request->breed,
                'vaccine' => $request->vaccine,
                'date' => $request->date,
                'user_id' => auth()->user()->id,
            ]);
            return response()->json($vet, 202);
        }catch(Exception $ex) {
            return response()->json([
                'message' => $ex->getMessage()
            ],500);
        }

    }

    public function update(Request $request, Vet $vet) {
        try {
            $vet->update($request->all());
            return response()->json($vet, 202);
        }catch(Exception $ex) {
            return response()->json(['message'=>$ex->getMessage()], 500);
        }
    }

    public function destroy(Vet $vet) {
        $vet->delete();
        return response()->json(['message'=>'vets deleted.'],202);
    }

    public function index() {
        $vets = Vet::where('user_id', auth()->user()->id)->orderBy('name')->get();
        return response()->json($vets, 200);
    }
}