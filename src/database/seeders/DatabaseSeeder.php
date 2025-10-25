<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\WeightLog;
use App\Models\WeightTarget;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // テストユーザー1名作成
        $user = User::create([
            'name' => 'テストユーザー',
            'email' => 'test@example.com',
            'password' => bcrypt('password'),
            'weight' => 50.0,
            'goal_weight' => 45.0,
        ]);

        // 目標体重1件
        WeightTarget::create([
            'user_id' => $user->id,
            'target_weight' => 45.0,
        ]);

        // 体重ログ35件
        for ($i = 0; $i < 35; $i++) {
            WeightLog::create([
                'user_id' => $user->id,
                'date' => now()->subDays($i)->format('Y-m-d'),
                'weight' => 50.0,
                'calories' => 2000,
                'exercise_time' => '00:30:00',
                'exercise_content' => 'ウォーキング 30分',
            ]);
        }
    }
}
