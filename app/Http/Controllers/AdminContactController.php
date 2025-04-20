<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminContactController extends Controller
{
    // Hiển thị danh sách các contact message
    public function index()
    {
        // Lấy tất cả các message từ bảng contact_messages
        $messages = DB::table('contact_messages')->orderBy('created_at', 'desc')->paginate(10);
        return view('admin.contact.index', compact('messages'));
    }

    // Hiển thị trang chi tiết contact message
    public function show($id)
    {
        $message = DB::table('contact_messages')->where('message_id', $id)->first();
        return view('admin.contact.show', compact('message'));
    }

    // Thay đổi trạng thái của message (mở/đóng)
    public function updateStatus($id)
    {
        $message = DB::table('contact_messages')->where('message_id', $id)->first();

        if ($message) {
            // Chuyển trạng thái từ chưa đọc (0) thành đã đọc (1) hoặc ngược lại
            $newStatus = $message->status == 0 ? 1 : 0;

            DB::table('contact_messages')->where('message_id', $id)->update([
                'status' => $newStatus,
                'updated_at' => now(),
            ]);

            return redirect()->route('admin.contact.index')->with('success', 'Cập nhật trạng thái thành công');
        }

        return redirect()->route('admin.contact.index')->with('error', 'Không tìm thấy tin nhắn');
    }

    // Xóa contact message
    public function destroy($id)
    {
        DB::table('contact_messages')->where('message_id', $id)->delete();

        return redirect()->route('admin.contact.index')->with('success', 'Đã xóa tin nhắn');
    }
}
