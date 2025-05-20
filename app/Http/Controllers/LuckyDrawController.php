<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Gift;

class LuckyDrawController extends Controller
{
    public function showDrawPage()
    {
        $gifts = Gift::all();
        return view('lucky_draw.index', compact('gifts'));
    }

    public function spinWheel()
    {
        $gift = Gift::where('quantity', '>', 0)->inRandomOrder()->first();

        if ($gift) {
            // Giảm số lượng quà sau khi trúng
            $gift->decrement('quantity');

            return response()->json([
                'success' => true,
                'message' => 'Chúc mừng! Bạn đã trúng: ' . $gift->name,
                'gift' => $gift
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Hết quà mất tiêu rồi 😭'
            ]);
        }
    }
}
