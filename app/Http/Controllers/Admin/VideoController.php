<?php

namespace App\Http\Controllers\Admin;

use App\Models\Video;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\{Validator, Cache, File, Response};

class VideoController extends Controller
{
    /**
     * Show the video gallery.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.video.index');
    }
    /**
     * Processes the AJAX request for retrieving category data as a datatable.
     *
     * This function handles an AJAX request to fetch a list of categorys with a parent_id of 0.
     * It allows filtering by status if provided. The resulting data is formatted for use with
     * DataTables, including custom rendering for the created_at date, status toggle, name link,
     * and edit action button.
     *
     * @param Request $request The incoming HTTP request containing optional status filter.
     * @return \Yajra\DataTables\DataTableAbstract JSON response formatted for DataTables.
     */
    public function ajaxTable(Request $request)
    {
        $status = $request->status;
        $videos = Video::when($status !== null, function ($query) use ($status) {
            return $query->where('status', '=', $status);
        });
        return Datatables::of($videos)
            ->addIndexColumn()
            ->editColumn('status', function ($data) {
                $checked = $data->status ? 'checked' : '';
                return '<div class="form-check form-switch">
                            <input type="checkbox" class="form-check-input status-switch" id="switch-' . $data->id . '" ' . $checked . '>
                            <label class="form-check-label" for="switch-' . $data->id . '"></label>
                        </div>';
            })
            ->addColumn('action', function ($data) {
                $action = "";
                $action .= '<a href="' . route('videos.edit', $data->id) . '" title="Edit" class="btn btn-sm btn-info"><i class="ri-edit-2-line"></i></a> ';
                return $action;
            })
            ->rawColumns(['status', 'action'])
            ->make(true);
    }
    /**
     * Show the form for creating a new video resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function create()
    {
        return view('admin.video.create');
    }
    /**
     * Store a newly created video resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    /**
     * Validation rules:
     * title: required|string|min:2|max:50|unique:photos,title
     * video: required
     *
     * If validation fails, return back to the form with error message.
     *
     * If the file is a video, upload it to the "uploads/video/" directory.
     *
     * Create a new Video model with the title and video path.
     * Return to the video index with a success message.
     *
     * If an exception occurs, catch it and return back to the form with an error message.
     */
    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'title' => 'required|string|min:2|max:50|unique:videos,title',
                'video' => 'required'
            ]);
            if ($validator->fails()) {
                return back()->with('error', $validator->errors()->first());
            }
            if ($request->hasFile('video')) {
                try {
                    $video = imageUpload($request->file('video'), 'uploads/video');
                } catch (\Exception $e) {
                    return back()->with('error', 'Could not upload your file: ' . $e->getMessage());
                }
            }
            Video::create([
                'title' => $request->title,
                'video' => $video,
            ]);
            Cache::forget('videos');
            return redirect()->route('videos.index')->with('success', __('Video Created Successfully'));
        } catch (\Exception $e) {
            dd($e);
            return back()->with('error', __('Something went wrong. Please try again.'));
        }
    }
    /**
     * Show the form for editing the specified video resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\View\View
     */
    public function edit($id)
    {
        $module_data = Video::findOrFail($id);
        return view('admin.video.edit', compact('module_data'));
    }
    /**
     * Update the specified video resource in storage.
     *
     * Validates the request data, updating the video record with the new title
     * and video file if provided. If validation fails, redirects back with an error message.
     * If a new video file is uploaded, deletes the old file and updates with the new file.
     * Clears the video cache upon successful update.
     *
     * @param \Illuminate\Http\Request $request The incoming HTTP request.
     * @param int $id The ID of the video to update.
     * @return \Illuminate\Http\RedirectResponse Redirect response upon success or failure.
     */
    public function update(Request $request, $id)
    {
        try {
            $validator = Validator::make($request->all(), [
                'title' => 'required|string|min:2|max:50|unique:videos,title,' . $id,
            ]);
            if ($validator->fails()) {
                return back()->with('error', $validator->errors()->first());
            }
            $video = Video::find($id);
            if ($request->hasFile('video')) {
                try {
                    if ($video->video && File::exists(public_path($video->video))) {
                        File::delete(public_path($video->video));
                    }
                    $video = imageUpload($request->file('video'), 'uploads/video');
                } catch (\Exception $e) {
                    return back()->with('error', 'Could not upload your file: ' . $e->getMessage());
                }
            }
            $video->update([
                'title' => $request->title,
                'video' => $video->video,
            ]);
            Cache::forget('videos');
            return redirect()->route('videos.index')->with('success', __('Video Updated Successfully'));
        } catch (\Exception $e) {
            dd($e);
            return back()->with('error', __('Something went wrong. Please try again.'));
        }
    }
    /**
     * Toggle the status of a video resource.
     *
     * Retrieves the video with the given ID, toggles its status between '1' (active) and '0' (inactive),
     * and returns a JSON response with a success message if the status is changed to active
     * or an error message if it is changed to inactive.
     *
     * @param \Illuminate\Http\Request $request The request containing the ID of the video.
     * @return \Illuminate\Http\JsonResponse A JSON response indicating the result of the status change.
     */
    public function status(Request $request)
    {
        $user = Video::findOrFail($request->id);
        $user->update(['status' => ($user->status == '1' ? '0' : '1')]);
        Cache::forget('videos');
        return Response::json([
            'success' => $user->status == '1' ? __('Video Activated Successfully.') : null,
            'error' => $user->status == '0' ? __('Video Deactivated Successfully.') : null,
        ]);
    }
}
