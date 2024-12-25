<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Goal;
use Illuminate\Support\Facades\Auth;

class ApiController extends Controller
{


    public function apiStore(Request $request)
    {
        // バリデーションを実施
        $goal = new Goal();
        $goal->goals_name = $request->goals_name;
        $goal->goals_deadline = $request->goals_deadline;
        $goal->goals_conditions = $request->goals_conditions;
        $goal->goals_reward = $request->goals_reward;
        $goal->goals_is_set = $request->goals_is_set;
        $goal->user_id = Auth::id();
        $goal->save();
        // レスポンスとホームへリダイレクト

        return response()->json([
            'message' => 'Data created successfully',
            'data' => $goal,
        ], 201)->header('Location', url('/home'));
    }

    public function destroy($id)
    {
        $task = Goal::find($id);
        $task->destroy($id);
        return response()->json([
            'message' => 'Data deleted successfully',
        ], 200);
    }
    public function reset($id)
    {
        $task = Goal::find($id);
        $task->goals_is_set = 0;
        $task->save();
        return response()->json([
            'message' => 'Data reset successfully',
        ], 200);
    }
}
