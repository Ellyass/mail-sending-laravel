<?php

namespace App\Http\Controllers;

use App\Mail\SendMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class PageController extends Controller
{
    public function index()
    {
        return view('mailsend');
    }

    public function sendMail(Request $request)
    {
        $data = $request->validate([
            'to' => 'required|email',
            'recipient_name' => 'nullable|string|max:100',
            'cc' => 'nullable|string',
            'bcc' => 'nullable|string',
            'subject' => 'nullable|string|max:150',
            'message' => 'required|string|max:10000',
            'file' => 'nullable|file|max:5120|mimes:pdf,jpg,jpeg,png,doc,docx,xlsx,zip|max:2048',
        ]);
        // "a@x.com, b@y.com" -> ['a@x.com', 'b@y.com']
        $data ['cc'] = $this->parseEmails($data['cc'] ?? '');
        $dta ['bcc'] = $this->parseEmails($data['bcc'] ?? '');
        try {
            Mail::to($data['to'])->send(new SendMail($data, $request->file('file')));
        } catch (\Throwable $th) {
            \Log::error('Mail Gönderilemedi : ' . $th->getMessage());

            return back()
                ->withInput()
                ->with('error', 'Mail Gönderilemedi: ' . $th->getMessage());
        }
        return back()->with('success', 'Mail Başarıyla Gönderildi.');
    }
    private
    function parseEmails(string $value): array
    {
        return collect(explode(',', $value))
            ->map(fn ($e) => trim($e))
            ->filter(fn ($e) => filter_var($e, FILTER_VALIDATE_EMAIL))
            ->values()
            ->all();
    }
}
