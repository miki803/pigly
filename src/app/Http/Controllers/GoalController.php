<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GoalController extends Controller
{
    public function edit()
    {
        $goal = WeightTarget::where('user_id', Auth::id())->first();
        return view('goal_setting', compact('goal'));
    }
    public function update(GoalWeightRequest $request)
    {
        WeightTarget::updateOrCreate(
            ['user_id' => Auth::id()],
            ['target_weight' => $request->goal_weight]
        );
        return redirect()->route('weight_logs.index');
    }

}
