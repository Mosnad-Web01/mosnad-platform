<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Bootcamp;
use Illuminate\Http\Request;

class BootcampController extends Controller
{
      // Fetch all bootcamps with pagination (10 per page)
      public function index(Request $request)
      {
          $bootcamps = Bootcamp::paginate(10);
          return response()->json($bootcamps);
      }
  
      // Fetch a single bootcamp by its ID
      public function show($id)
      {
          $bootcamp = Bootcamp::find($id);
  
          if (!$bootcamp) {
              return response()->json(['message' => 'Bootcamp not found'], 404);
          }
  
          return response()->json($bootcamp);
      }
}
