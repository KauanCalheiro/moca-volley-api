<?php

Route::middleware('web')->group(function () {
    Route::get('/telescope-login', function () {
        return view('telescope-login');
    })->name('telescope.login');

    Route::post('/telescope-login', function (\Illuminate\Http\Request $request) {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            return redirect('/telescope');
        }

        return back()->withErrors([
            'email' => 'Credenciais inválidas.',
        ]);
    });
});
