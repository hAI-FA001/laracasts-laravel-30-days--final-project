<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\File;
use Illuminate\Validation\Rules\Password;

class RegisteredUserController extends Controller
{
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('auth.register');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $userAttrs = $request->validate([
            'name' => ['required'],
            'email'=>['required', 'email', 'unique:users,email'],
            'password' => ['required', 'confirmed', Password::min(6)],
        ]);
        
        $employerAttrs = $request->validate([
            'employer' => ['required'],
            'logo' => ['required', File::types(['png', 'jpg', 'webp'])],
            
        ]);

        // benefit of splitting user and employer validation
        $user = User::create($userAttrs);
        
        // configure in config/filesystems.php, includes options like local storage, S3, FTP etc
        // change FILESYSTEM_DISK env var to public, which will store it under storage/app/public and make a symbolic link in public/
        $logoPath = $request->logo->store('logos');
        $user->employer()->create([
            'name' => $employerAttrs['employer'],
            'logo' => $logoPath,
        ]);

        Auth::login($user);

        return redirect('/');
    }
}
