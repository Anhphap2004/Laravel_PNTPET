<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    protected $table = 'contact_messages'; // Đổi bảng thành contact_messages
    protected $primaryKey = 'message_id'; // Định nghĩa khóa chính

    protected $fillable = ['name', 'email', 'phone', 'subject', 'message', 'status', 'ip_address'];
}
