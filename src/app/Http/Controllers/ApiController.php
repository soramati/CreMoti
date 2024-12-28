<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Goal;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class ApiController extends Controller
{


    public function apiIndex()
    {
        $goals = Goal::where('user_id', Auth::id())->get();
        if ($goals->isEmpty()) {
            return response()->json([
                'message' => 'Data not found',
                'isData' => '0',
            ], 200);
        }
        return response()->json([
            'message' => 'Data read successfully',
            'isData' => '1',
            'data' => $goals,
        ], 200);
    }

    public function apiStore(Request $request)
    {
        // バリデーションを実施
        Goal::where('user_id', Auth::id())->update(['goals_is_set' => 0]);
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
    public function apiStart($id)
    {
        Goal::where('user_id', Auth::id())->update(['goals_is_set' => 0]);
        $task = Goal::find($id);
        $task->goals_is_set = 1;
        $task->save();
        return response()->json([
            'message' => 'Data start successfully',
        ], 200);
    }
    public function apiDone($id)
    {
        $task = Goal::find($id);
        $task->goals_is_achieved = 1;
        $task->save();
        return response()->json([
            'message' => 'Data done successfully',
        ], 200);
    }
}
