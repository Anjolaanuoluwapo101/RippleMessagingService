<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;

class LogoutController extends Controller
{   
    public show()
    {
      return view('auth.logout');
    }
    
    public function handle()
    {
        auth()->logout();

        return redirect()->route('login');
    }
    
    
}
