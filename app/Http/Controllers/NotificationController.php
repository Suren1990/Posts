<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function index(){
        $notifications = auth()->user()
        ->notifications()
        ->orderBy('created_at', 'desc')
        ->paginate(6);

        return view('notifications.index', compact('notifications'));
    }

    public function show($id){
        return redirect('/notifications');
    }

    public function edit($id){
        return redirect('/notifications');
    }

    public function markAsRead($id)
    {
        $notification = auth()->user()->notifications()->findOrFail($id);
        $notification->markAsRead();

        return redirect()->route('notifications.index');
    }

    public function destroy($id)
    {
        $notification = auth()->user()->notifications()->findOrFail($id);
        $notification->delete();

        return redirect()->route('notifications.index');
    }
}
