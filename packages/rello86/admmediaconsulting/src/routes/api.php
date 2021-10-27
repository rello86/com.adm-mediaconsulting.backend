<?php

    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Route;
    use Rello86\AdmMediaConsulting\Http\Resources\PeopleResource;
    use Rello86\AdmMediaConsulting\Models\People;

    Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
        return $request->user();
    });

    Route::get('api/peoples/{perPage?}/{orderBy?}/{search?}', function ( $perPage = 10, $orderBy = 'name', $search = '') {
        return PeopleResource::collection(People::where('name', 'like', '%'.$search.'%')->orderBy($orderBy)->paginate($perPage));
    });

    Route::get('api/people/{peopleId}', function ($peopleId = NULL) {
        return new PeopleResource(People::findOrFail($peopleId)->load(['planet']));
    });
