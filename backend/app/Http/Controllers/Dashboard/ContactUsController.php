<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\ContactUs;
use App\Models\Reply;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactUsController extends Controller
{
    public function index()
    {
        $contactUsMessages = ContactUs::orderBy('created_at', 'desc')->paginate(10);
        return view('dashboard.contact-us.index', compact('contactUsMessages'));
    }

    public function show($id)
    {
        $message = ContactUs::findOrFail($id);
        $repliesCount = $message->replies()->count(); // Count the replies associated with this message

        return view('dashboard.contact-us.show', compact('message', 'repliesCount'));
    }

    public function reply(Request $request, $id)
{
    $message = ContactUs::findOrFail($id);

    // Validate the reply input
    $request->validate([
        'reply' => 'required|string|max:1000',
    ]);

    // Create a reply
    $reply = new Reply();
    $reply->contact_us_id = $message->id;
    $reply->reply = $request->reply; 
    $reply->save();

    // Send the email notification to the user directly
    Mail::raw("تم الرد على رسالتك: {$reply->reply}", function($mail) use ($message) {
        $mail->to($message->email)
             ->subject('تم إرسال رد جديد على رسالتك');
    });

    // Redirect back with success message
    return redirect()->route('dashboard.contact-us.show', $id)->with('success', 'تم إرسال الرد بنجاح');
}
}
