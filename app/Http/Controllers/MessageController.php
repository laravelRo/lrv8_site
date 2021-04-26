<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;
use App\Http\Requests\MessageNewRequest;
use Illuminate\Support\Facades\Mail;

class MessageController extends Controller
{
    public function newMessage(MessageNewRequest $request)
    {
        $message = new Message;

        $message->name = $request->name;
        $message->email = $request->email;
        $message->phone = $request->phone;
        $message->subject = $request->subject;
        $message->message = $request->message;

        $message->save();

        // trimitem un mail administratorului
        Mail::send('admin.email.new-message', [
            'name' => $request->name,
            'phone' => $request->phone,
            'email' => $request->email,
            'subject' => $request->subject,
            'mess' => $request->message,
        ], function ($m) use ($request) {
            $m->from($request->email);
            $m->to(config('custominfo.email'))->subject('Un nou mesaj de pe situl Weg-Design. Raspundeti cat mai repede!');
        });

        return back()->with('success', 'Mesajul Dvs a fost trimis. Va vom raspunde cat mai repede posibil.');
    }

    public function showMessages()
    {
        $messages = Message::all()->sortByDesc('created_at');

        return view('admin.email.contact-messages')->with('messages', $messages);
    }

    public function deleteMessage($id)
    {
        $message = Message::findOrFail($id);
        $message->delete();
        return back()->with('success', 'Mesajul a fost sters din baza de date!');
    }
}
