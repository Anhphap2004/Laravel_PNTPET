<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ChatbotController extends Controller
{
    public function handle(Request $request)
    {
        $message = strtolower($request->input('message'));

        $responses = [
            'tôi muốn đăng ký' => "Bạn có thể đăng ký dịch vụ chăm sóc thú cưng trực tiếp trên website hoặc gọi hotline 1900-THUCUNG nhé! 📞",
            'tôi muốn biết giá' => "Giá dịch vụ chăm sóc thú cưng dao động từ 100k đến 500k tuỳ vào dịch vụ bạn chọn đó nè. 💸",
            'giá thú cưng như thế nào' => "Mỗi loại thú cưng có mức giá khác nhau, bạn muốn biết về chó, mèo, hay hamster nè? 🐶🐱🐹",
            'tôi muốn biết cách nuôi' => "Bạn cần tư vấn nuôi thú cưng đúng cách? Mình có thể chia sẻ về ăn uống, chơi đùa và chăm sóc sức khỏe cho bé nè! 📚",
            'thú cưng của bạn ở đâu' => "Shop mình ở 123 Đường Yêu Thú, TP. Hồ Chí Meo nha. Bạn ghé chơi với tụi nhỏ đi~ 🏡",
            'địa chỉ shop ở đâu' => "Địa chỉ của chúng mình là 123 Đường Yêu Thú, Quận Cưng Xỉu, TP. Hồ Chí Meo nè~ 🗺️",
            'giờ làm việc của shop là gì' => "Shop mở cửa từ 8h sáng đến 8h tối, tất cả các ngày trong tuần luôn á! ⏰",
            'tôi gặp lỗi khi đăng ký' => "Bạn gặp lỗi gì khi đăng ký vậy? Nói rõ giúp mình để hỗ trợ cho nhanh nhen~ 🛠️",
            'thú cưng có biểu hiện lạ' => "Nếu bé có dấu hiệu bất thường, bạn nên liên hệ bác sĩ thú y hoặc mang bé tới shop để tụi mình chăm ngay nha! 🏥",
            'tôi muốn tìm chó' => "Bạn đang tìm chó giống gì nè? Poodle, Husky, Corgi hay Golden tụi mình đều có hết! 🐶",
            'tôi muốn tìm mèo' => "Tụi mình có British Shorthair, Mèo ta, Mèo Anh lông dài, Maine Coon... Bạn thích em nào? 🐱",
            'tôi muốn tìm thỏ' => "Thỏ bên mình dễ nuôi, đáng yêu cực! Có thỏ Holland Lop, Mini Rex, thỏ tai cụp dễ xỉu luôn á! 🐰",
            'tôi muốn tìm hamster' => "Hamster tụi mình siêu xinh, có dòng Winter White, Roborovski, Campbell’s... bé xíu mà mê ly~ 🐹",
            'shop có khuyến mãi không' => "Có chớ! Hiện tại đang có giảm 10% cho khách hàng mới nè~ 🎉",
            'dịch vụ chăm sóc gồm gì' => "Gồm tắm, cắt lông, vệ sinh tai, răng, và tiêm phòng cho bé nữa đó nha~ 🧼",
            // 👋 Các câu chào
            'chào' => "Xin chào bạn iu dễ thương 🥰 Bạn muốn hỏi gì về thú cưng nè? 🐾",
            'xin chào' => "Chào bạn nghen! Hôm nay bạn muốn hỏi gì về mấy bé thú cưng hông? 🐶🐱",
            'hello' => "Hello người bạn yêu động vật 🐾 Cần mình tư vấn gì hông nè?",
            'hi' => "Hi hi! Bạn cần biết gì về thú cưng không? Mình ở đây để hỗ trợ nè~ 😘",
        ];

        // Kiểm tra từ khóa chính xác
        foreach ($responses as $keyword => $reply) {
            if ($message == $keyword) {
                return response()->json(['reply' => $reply]);
            }
        }

        // Kiểm tra từ khóa có chứa trong message
        foreach ($responses as $keyword => $reply) {
            if (strpos($message, $keyword) !== false) {
                return response()->json(['reply' => $reply]);
            }
        }

        // Trả lời mặc định nếu không tìm thấy từ khóa
        $defaultReplies = [
            "Bạn muốn tìm hiểu về dịch vụ nào? Mình có chăm sóc, mua bán, tư vấn đầy đủ luôn nha! 🐾",
            "Mình chưa hiểu rõ câu hỏi, bạn thử hỏi lại theo kiểu: 'Tôi muốn biết giá', 'Tôi muốn đăng ký' nha~ 😺",
            "Bạn hỏi thử về giống thú cưng, địa chỉ shop, hay giờ mở cửa thử coi? Mình biết tuốt luôn á! 😎",
            "Thú cưng là chân ái 🐾 Bạn muốn mình gợi ý thú cưng nào phù hợp với bạn hông?",
            "Cứ hỏi thoải mái nha, mình ở đây vì bạn và vì tụi nhỏ dễ thương nè~ 🐶🐱",
        ];

        $randomReply = $defaultReplies[array_rand($defaultReplies)];

        return response()->json(['reply' => $randomReply]);
    }
}
