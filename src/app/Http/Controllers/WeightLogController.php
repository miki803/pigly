<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WeightLogController extends Controller
{
    public function index()
    {
        $weightLogs = WeightLog::where('user_id', Auth::id())->orderBy('date', 'desc')->get();

        return view('admin', compact('weightLogs'));
    }
    public function edit($id)
    {
        $log = WeightLog::findOrFail($id);
        return view('data', compact('log'));
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'weight' => 'required|numeric|min:1',
            'calories' => 'required|numeric|min:0',
            'exercise_time' => 'required|numeric|min:0',
            'exercise_detail' => 'nullable|string|max:255',
        ]);

        $log = WeightLog::findOrFail($id);
        $log->update($request->only(['weight', 'calories', 'exercise_time', 'exercise_detail']));

        return redirect('/admin')->with('success', 'データを更新しました');
    }
    public function destroy($id)
    {
        $log = WeightLog::findOrFail($id);
        $log->delete();

        return redirect('/admin')->with('success', '削除しました');
    }


}