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

        if (isset($update['message'])) {
            $message = $update['message'];
            $chat_id = $message['chat']['id'];
            $text = $message['text'] ?? '';

            if (str_starts_with($text, '/start')) {
                $parts = explode(' ', $text);
                $user_id = $parts[1] ?? null;

                if ($user_id) {
                    $admin = Admin::find($user_id);
                    if ($admin) {
                        $admin->telegram_chat_id = $chat_id;
                        $admin->save();

                        // إرسال رسالة تأكيد للإدمن
                        $this->sendTelegramMessage($chat_id, "تم ربط حسابك بنجاح مع النظام.");
                    }
                }
            }
        }

        return response()->json(['status' => 'ok']);
    }

    private function sendTelegramMessage($chat_id, $text)
    {
        $botToken = env('TELEGRAM_BOT_TOKEN');
        Http::post("https://api.telegram.org/bot{$botToken}/sendMessage", [
            'chat_id' => $chat_id,
            'text' => $text,
        ]);
    }
}
