<?php

namespace App\Http\Controllers\API\V1;

use App\Models\Character;
use App\Http\Requests\StoreCharacterRequest;
use App\Http\Requests\UpdateCharacterRequest;
use App\Http\Controllers\Controller;
use App\Http\Requests\BulkStoreCharacterRequest;
use App\Http\Resources\V1\CharacterCollection;
use App\Http\Resources\V1\CharacterResource;
use App\Services\V1\CharacterQuery;
use Illuminate\Http\Request;

class CharacterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $filter = new CharacterQuery();
        $queryItems = $filter->transform($request);
        if (count($queryItems) == 0){
            return new CharacterCollection(Character::paginate());
        } else {
            return new CharacterCollection(Character::where($queryItems)->paginate());
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCharacterRequest $request)
    {
        return new CharacterResource(Character::create($request->all()));
    }

    public function bulkStore(BulkStoreCharacterRequest $request) {
        Character::insert($request->all());
    }

    /**
     * Display the specified resource.
     */
    public function show(Character $character)
    {
        return new CharacterResource($character);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Character $character)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCharacterRequest $request, Character $character)
    {
        $character->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Character $character)
    {
        //
    }
}
