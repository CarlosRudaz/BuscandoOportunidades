<?php

namespace App\Http\Controllers;

use App\Http\Requests\EmprendedorRequest;
use App\Http\Resources\EmprendedorResource;
use App\Models\Emprendedor;

class EmprendedorController extends Controller
{
    public function index()
    {
        $this->authorize('viewAny', Emprendedor::class);

        return EmprendedorResource::collection(Emprendedor::all());
    }

    public function store(EmprendedorRequest $request)
    {
        $this->authorize('create', Emprendedor::class);

        return new EmprendedorResource(Emprendedor::create($request->validated()));
    }

    public function show(Emprendedor $emprendedor)
    {
        $this->authorize('view', $emprendedor);

        return new EmprendedorResource($emprendedor);
    }

    public function update(EmprendedorRequest $request, Emprendedor $emprendedor)
    {
        $this->authorize('update', $emprendedor);

        $emprendedor->update($request->validated());

        return new EmprendedorResource($emprendedor);
    }

    public function destroy(Emprendedor $emprendedor)
    {
        $this->authorize('delete', $emprendedor);

        $emprendedor->delete();

        return response()->json();
    }
}
