<?php

namespace App\Http\Controllers;

use App\Models\Cat;
use app\src\Request\CreateCatRequest;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

class CatController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Cat::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateCatRequest $data)
    {
        return new JsonResponse(Cat::create($data->all()), 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Cat $cat)
    {
        return $cat;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CreateCatRequest $requestFromUser, Cat $cat)
    {
        $cat->update($requestFromUser->all());
        return $cat;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cat $cat)
    {
        $cat->delete();
        return new JsonResponse(['message'=>'Кот убежал']);
    }
}
