<?php

namespace App\Http\Controllers;
use Auth;
use Illuminate\Http\Request;
use App\Models\Message;
use App\Events\MessageSent;
class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        $messages=Message::paginate(20);
        return view('backend.message.index')->with('messages',$messages);
    }
    public function messageFive()
    {
        $message=Message::whereNull('read_at')->limit(5)->get();
        return response()->json($message);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.message.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Add debugging for form submission
        \Log::info('Contact form submitted', [
            'request_data' => $request->all(),
            'has_attachment' => $request->hasFile('attachment'),
            'ip' => $request->ip(),
            'user_agent' => $request->userAgent()
        ]);
        
        try {
            $this->validate($request,[
                'name'=>'string|required|min:2',
                'email'=>'email|required',
                'message'=>'required|min:20|max:1000',
                'subject'=>'string|required',
                'phone'=>'nullable|string', // phone is optional for frontend form
                'attachment' => 'nullable|file|mimes:pdf,doc,docx,jpg,jpeg,png|max:5120',
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            \Log::error('Contact form validation failed', [
                'errors' => $e->errors(),
                'request_data' => $request->all()
            ]);
            return redirect()->back()->withErrors($e->errors())->withInput();
        }

        $data = $request->only(['name', 'email', 'message', 'subject', 'phone']);
        if ($request->hasFile('attachment')) {
            $data['attachment'] = $request->file('attachment')->store('messages', 'public');
        }
        
        // Add debugging
        \Log::info('Creating message with data:', $data);
        
        $message = Message::create($data);
        
        if ($message) {
            \Log::info('Message created successfully with ID: ' . $message->id);
            
            $data['url'] = route('message.show', $message->id);
            $data['date'] = $message->created_at->format('F d, Y h:i A');
            $data['photo'] = Auth()->user()->photo ?? null;
            
            try {
                event(new MessageSent($data));
                \Log::info('MessageSent event fired successfully');
            } catch (\Exception $e) {
                \Log::error('Error firing MessageSent event: ' . $e->getMessage());
            }
            
            return redirect()->back()->with('success', 'Votre message a bien été envoyé.');
        } else {
            \Log::error('Failed to create message');
            return redirect()->back()->with('error', 'Erreur lors de l\'envoi du message. Veuillez réessayer.');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request,$id)
    {
        $message=Message::find($id);
        if($message){
            $message->read_at=\Carbon\Carbon::now();
            $message->save();
            return view('backend.message.show')->with('message',$message);
        }
        else{
            return back();
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $message = Message::find($id);
        if (!$message) {
            request()->session()->flash('error', 'Message not found');
            return redirect()->route('message.index');
        }
        return view('backend.message.edit')->with('message', $message);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $message = Message::find($id);
        if (!$message) {
            request()->session()->flash('error', 'Message not found');
            return redirect()->route('message.index');
        }

        $this->validate($request, [
            'name' => 'string|required|min:2',
            'email' => 'email|required',
            'message' => 'required|min:20|max:200',
            'subject' => 'string|required',
            'phone' => 'nullable|string',
            'attachment' => 'nullable|file|mimes:pdf,doc,docx,jpg,jpeg,png|max:5120',
        ]);

        $data = $request->only(['name', 'email', 'message', 'subject', 'phone']);

        // Handle new attachment upload
        if ($request->hasFile('attachment')) {
            // Delete old attachment if exists
            if ($message->attachment && file_exists(storage_path('app/public/' . $message->attachment))) {
                unlink(storage_path('app/public/' . $message->attachment));
            }
            $data['attachment'] = $request->file('attachment')->store('messages', 'public');
        }

        $status = $message->fill($data)->save();
        
        if ($status) {
            request()->session()->flash('success', 'Message updated successfully');
        } else {
            request()->session()->flash('error', 'Error occurred while updating message');
        }
        
        return redirect()->route('message.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $message = Message::find($id);
        if (!$message) {
            request()->session()->flash('error', 'Message not found');
            return redirect()->route('message.index');
        }

        // Delete attachment file if exists
        if ($message->attachment && file_exists(storage_path('app/public/' . $message->attachment))) {
            unlink(storage_path('app/public/' . $message->attachment));
        }

        $status = $message->delete();
        if ($status) {
            request()->session()->flash('success', 'Message deleted successfully');
        } else {
            request()->session()->flash('error', 'Error occurred while deleting message');
        }
        return redirect()->route('message.index');
    }

    /**
     * Download attachment file
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function downloadAttachment($id)
    {
        $message = Message::find($id);
        if (!$message || !$message->attachment) {
            request()->session()->flash('error', 'Attachment not found');
            return redirect()->route('message.index');
        }

        $filePath = storage_path('app/public/' . $message->attachment);
        if (!file_exists($filePath)) {
            request()->session()->flash('error', 'File not found on server');
            return redirect()->route('message.index');
        }

        $fileName = basename($message->attachment);
        return response()->download($filePath, $fileName);
    }

    /**
     * Delete attachment from message
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function deleteAttachment($id)
    {
        $message = Message::find($id);
        if (!$message) {
            request()->session()->flash('error', 'Message not found');
            return redirect()->route('message.index');
        }

        if ($message->attachment) {
            // Delete file from storage
            if (file_exists(storage_path('app/public/' . $message->attachment))) {
                unlink(storage_path('app/public/' . $message->attachment));
            }
            
            // Remove attachment from database
            $message->attachment = null;
            $message->save();
            
            request()->session()->flash('success', 'Attachment deleted successfully');
        } else {
            request()->session()->flash('error', 'No attachment found');
        }

        return redirect()->back();
    }

    /**
     * Mark message as read/unread
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function toggleReadStatus($id)
    {
        $message = Message::find($id);
        if (!$message) {
            request()->session()->flash('error', 'Message not found');
            return redirect()->route('message.index');
        }

        if ($message->read_at) {
            $message->read_at = null;
            $status = 'unread';
        } else {
            $message->read_at = now();
            $status = 'read';
        }

        $message->save();
        request()->session()->flash('success', "Message marked as {$status}");
        return redirect()->back();
    }

    /**
     * Bulk delete messages
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function bulkDelete(Request $request)
    {
        $ids = $request->input('message_ids', []);
        
        if (empty($ids)) {
            request()->session()->flash('error', 'No messages selected');
            return redirect()->back();
        }

        $deleted = 0;
        foreach ($ids as $id) {
            $message = Message::find($id);
            if ($message) {
                // Delete attachment file if exists
                if ($message->attachment && file_exists(storage_path('app/public/' . $message->attachment))) {
                    unlink(storage_path('app/public/' . $message->attachment));
                }
                $message->delete();
                $deleted++;
            }
        }

        request()->session()->flash('success', "Successfully deleted {$deleted} messages");
        return redirect()->route('message.index');
    }
}
