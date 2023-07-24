<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Jetstream\Jetstream;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array<string, string>  $input
     */
    public function create(array $input): User
    {
        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => $this->passwordRules(),
            'password_confirmation' => ['same:password'],
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['accepted', 'required'] : '',
            'phone' => ['required', 'string', 'max:255'],
            'role' => ['required', 'string', 'max:255', 'in:sender,receiver'],
            'avatar' => ['nullable', 'image', 'max:1024', 'mimetype:image/png,image/jpeg,image/jpg'],
        ])->validate();

        $input['profile_photo_path'] = null;

        if (request()->hasFile('avatar')) {
            $image = request()->file('avatar');
            $imageName = time().$input['id'].'.'.$image->extension();
            $image->move(public_path('/uploads/users/avaters/'),$imageName);
            $input['profile_photo_path'] = '/uploads/users/avaters/'.$imageName;
        }

        return User::create([
            'name' => $input['name'],
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
            'phone' => $input['phone'],
            'role' => $input['role'],
            'profile_photo_path' => $input['profile_photo_path'],
        ]);
    }
}
