<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Announcement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AnnouncementController extends Controller
{
    public function index()
    {
        $announcements = Announcement::with('creator')->latest()->paginate(15);
        return view('admin.announcements.index', compact('announcements'));
    }

    public function create()
    {
        return view('admin.announcements.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title'        => 'required|string|max:191',
            'message'      => 'required|string',
            'type'         => 'required|in:info,warning,success,danger',
            'status'       => 'required|in:draft,published',
            'published_at' => 'nullable|date',
        ]);

        $data['created_by'] = Auth::id();
        if ($data['status'] === 'published' && empty($data['published_at'])) {
            $data['published_at'] = now();
        }

        Announcement::create($data);

        return redirect()->route('admin.announcements.index')
                         ->with('success', 'Announcement created.');
    }

    public function edit(Announcement $announcement)
    {
        return view('admin.announcements.edit', compact('announcement'));
    }

    public function update(Request $request, Announcement $announcement)
    {
        $data = $request->validate([
            'title'        => 'required|string|max:191',
            'message'      => 'required|string',
            'type'         => 'required|in:info,warning,success,danger',
            'status'       => 'required|in:draft,published',
            'published_at' => 'nullable|date',
        ]);

        $announcement->update($data);

        return redirect()->route('admin.announcements.index')
                         ->with('success', 'Announcement updated.');
    }

    public function destroy(Announcement $announcement)
    {
        $announcement->delete();
        return redirect()->route('admin.announcements.index')
                         ->with('success', 'Announcement deleted.');
    }

    public function show(Announcement $announcement)
    {
        return view('admin.announcements.show', compact('announcement'));
    }
}
