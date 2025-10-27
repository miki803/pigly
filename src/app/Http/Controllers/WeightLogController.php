<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\WeightLog;
use App\Models\WeightTarget;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\WeightLogRequest;
use App\Http\Requests\GoalWeightRequest;

class WeightLogController extends Controller
{
    // 一覧（管理画面）
    public function index(Request $request)
    {
        $userId = Auth::id() ?? 1;

        $query = WeightLog::where('user_id', $userId);

        if ($request->filled('start_date') && $request->filled('end_date')) {
        $query->whereBetween('date', [$request->start_date, $request->end_date]);
        }

        $weightLogs = $query->orderBy('date', 'desc')->paginate(8);

        $goal = WeightTarget::where('user_id', $userId)->first();
        $goal_weight = $goal->target_weight ?? 0;
        $latest_weight = $weightLogs->first()?->weight ?? 0;

        return view('admin', [
            'weightLogs' => $weightLogs,
            'goal_weight' => $goal_weight,
            'latest_weight' => $latest_weight,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
        ]);
    }

    // 検索
    public function search(Request $request)
    {
        $user = Auth::user();
        if (!$user) return redirect()->route('login');

        $start = $request->input('start_date');
        $end = $request->input('end_date');

        $weightLogs = WeightLog::where('user_id', $user->id)
            ->whereBetween('date', [$start, $end])
            ->orderBy('date', 'desc')
            ->paginate(8);

        $goal = WeightTarget::where('user_id', $user->id)->first();
        $goal_weight = $goal->target_weight ?? 0;
        $latest_weight = $weightLogs->first()?->weight ?? 0;

        return view('admin', compact('weightLogs', 'goal_weight', 'latest_weight', 'start', 'end'));
    }

    // 作成画面（新規登録）
    public function create()
    {
        return view('weight_logs.create');
    }

    // 登録処理
    public function store(WeightLogRequest $request)
    {
        WeightLog::create([
            'user_id' => Auth::id(),
            'date' => $request->date,
            'weight' => $request->weight,
            'calories' => $request->calories,
            'exercise_time' => $request->exercise_time,
            'exercise_content' => $request->exercise_content,
        ]);

        return redirect()->route('weight_logs.index');
    }
    // 詳細画面（編集ページ）
    public function show(WeightLog $weightLog)
    {
        return view('data', compact('weightLog'));
    }
    // 更新処理（PATCH /weight_logs/{id}/update）
    public function update(WeightLogRequest $request, WeightLog $weightLog)
    {
        $weightLog->update($request->validated());
        return redirect()->route('weight_logs.index');
    }
    // 削除処理（DELETE /weight_logs/{id}/delete）
    public function destroy(WeightLog $weightLog)
    {
        $weightLog->delete();
        return redirect()->route('weight_logs.index');
    }
    // 目標体重設定画面
    public function goalSetting()
    {
        $userId = Auth::id() ?? 1;
        $goal = WeightTarget::where('user_id', $userId)->first();

        if (!$goal) {
        // データがない場合は新規作成する
        $goal = WeightTarget::create([
            'user_id' => $userId,
            'target_weight' => 0,
            ]);
        }
        return view('goal_setting', compact('goal'));
    }
    // 目標体重更新処理
    public function updateGoal(GoalWeightRequest $request)
    {
        WeightTarget::updateOrCreate(
            ['user_id' => Auth::id()],
            ['target_weight' => $request->goal_weight]
        );

        return redirect()->route('weight_logs.index');
    }
}