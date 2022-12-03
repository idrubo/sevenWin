<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class playerController extends Controller
{
  public function showPlayer (Request $request)
  {
    return response ()->json (request ()->user ());
  }
}

