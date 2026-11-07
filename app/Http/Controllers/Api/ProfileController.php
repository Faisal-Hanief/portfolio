<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileRequest;
use App\Http\Resources\ProfileResource;
use App\Models\Profile;

class ProfileController extends Controller
{
    public function show()
    {
        return new ProfileResource(Profile::firstOrFail());
    }

    public function update(ProfileRequest $request)
    {
        $profile = Profile::firstOrFail();
        $profile->update($request->validated());

        return new ProfileResource($profile);
    }
}