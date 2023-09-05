<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

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
