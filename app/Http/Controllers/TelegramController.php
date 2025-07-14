<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;


class TelegramController extends Controller
{
    public function handleWebhook(Request $request)
    {
        $update = $request->all();

        // تأكد أن التحديث يحتوي على رسالة
        if (!isset($update['message'])) {
            return response()->json(['status' => 'no message']);
        }

        $message = $update['message'];
        $chatId = $message['chat']['id'];
        $text = $message['text'] ?? '';

        // تعيين اللغة حسب اللغة القادمة من المستخدم
        $lang = $message['from']['language_code'] ?? 'en';
        $lang = in_array($lang, ['ar', 'en']) ? $lang : 'en';
        app()->setLocale($lang);

        if ($text === '/start') {
            $this->sendTelegramMessage($chatId, __('telegram.start'));
            return response()->json(['status' => 'start sent']);
        }

        // تحقق من رمز التفعيل
        $admin = Admin::where('activation_code', $text)->first();

        if ($admin) {
            if (!$admin->telegram_chat_id) {
                $admin->telegram_chat_id = $chatId;
                $admin->save();

                $this->sendTelegramMessage($chatId, __('telegram.linked'));
            } else {
                $this->sendTelegramMessage($chatId, __('telegram.already_linked'));
            }
        } else {
            $this->sendTelegramMessage($chatId, __('telegram.invalid_code'));
        }

        return response()->json(['status' => 'processed']);
    }

    private function sendTelegramMessage($chatId, $message)
    {
        $botToken = env('TELEGRAM_BOT_TOKEN');
        $url = "https://api.telegram.org/bot$botToken/sendMessage";

        Http::post($url, [
            'chat_id' => $chatId,
            'text' => $message,
            'parse_mode' => 'HTML',
        ]);
    }
}
