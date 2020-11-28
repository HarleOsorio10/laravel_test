<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller;
use App\Models\Scores;
use Illuminate\Http\Request;
class Fetch extends Controller
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function GetData(Request $request){
        $date = $request->get('date');
        return response()->json([
            'data' => Scores::where('timestamp', 'like', '%' . $date . '%')->get(),
            'status' => 200,
            'message' => 'Succeeded',
        ]);
    }

    public function SaveData(Request $request){
        $score = $request->get('score');
        Scores::insert(array('score' => $score));
        return response()->json([
            'status' => 200,
            'message' => 'inserted',
        ]);
    }
}