<?php

namespace App\Http\Controllers\Admin;

use App\Models\Widget;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\{Validator, Cache, Response};

class MediaController extends Controller
{
    /**
     * Show the media management interface.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('admin.media.index');
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
        $widgets = Widget::where('widget_type', 'media')->when($status !== null, function ($query) use ($status) {
            return $query->where('status', '=', $status);
        });
        return Datatables::of($widgets)
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
                $action .= '<a href="' . route('media.edit', $data->id) . '" title="Edit" class="btn btn-sm btn-info"><i class="ri-edit-2-line"></i></a> ';
                return $action;
            })
            ->rawColumns(['status', 'action'])
            ->make(true);
    }
    /**
     * Show the form for creating a new media resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('admin.media.create');
    }
    /**
     * Store a newly created media resource in storage.
     *
     * Validates the request data for a media widget name, ensuring it is unique
     * and meets the specified character limits. If validation fails, redirects
     * back with an error message. If the validation passes, creates a new media
     * widget with the provided name, content, and type, and redirects to the
     * media index with a success message. If an exception occurs during the
     * process, catches the exception and redirects back to the form with an
     * error message.
     *
     * @param \Illuminate\Http\Request $request The incoming request instance.
     * @return \Illuminate\Http\RedirectResponse Redirect response upon success or failure.
     */
    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'title' => 'required|string|min:2|max:50|unique:widgets,widget_name',
            ]);
            if ($validator->fails()) {
                return back()->with('error', $validator->errors()->first());
            }
            Widget::create([
                'widget_name' => $request->title,
                'content' => $request->content,
                'widget_type' => 'media'
            ]);
            Cache::forget('media');
            return redirect()->route('media.index')->with('success', 'Media Created Successfully');
        } catch (\Exception $e) {
            dd($e);
            return back()->with('error', 'Something went wrong. Please try again.');
        }
    }
    /**
     * Display the specified media for editing.
     *
     * Retrieves the media with the given ID and renders the edit view.
     *
     * @param int $id The ID of the media to edit.
     * @return \Illuminate\View\View The edit view for the media.
     */
    public function edit($id)
    {
        $module_data = Widget::find($id);
        return view('admin.media.edit', compact('module_data'));
    }
    /**
     * Update the specified media in storage.
     *
     * Validates the request data, updating the media record with the new name
     * and content if provided. If validation fails, redirects back with an error message.
     * Clears the media cache upon successful update.
     *
     * @param \Illuminate\Http\Request $request The incoming HTTP request.
     * @param int $id The ID of the media to update.
     * @return \Illuminate\Http\RedirectResponse Redirect response upon success or failure.
     */
    public function update(Request $request, $id)
    {
        try {
            $validator = Validator::make($request->all(), [
                'title' => 'required|string|min:2|max:50|unique:widgets,widget_name,' . $id,
            ]);
            if ($validator->fails()) {
                return back()->with('error', $validator->errors()->first());
            }
            $widget = Widget::find($id);
            $widget->update([
                'widget_name' => $request->title,
                'content' => $request->content,
                'widget_type' => 'media'
            ]);
            Cache::forget('media');
            return redirect()->route('media.index')->with('success', 'Media Updated Successfully');
        } catch (\Exception $e) {
            dd($e);
            return back()->with('error', 'Something went wrong. Please try again.');
        }
    }
    /**
     * Toggles the status of the specified media item between active and inactive.
     *
     * Retrieves the media item with the given ID, toggles its status between '1' (active) and '0' (inactive),
     * and returns a JSON response with a success message if the status is changed to active
     * or an error message if it is changed to inactive.
     *
     * @param \Illuminate\Http\Request $request The request containing the ID of the media item.
     * @return \Illuminate\Http\JsonResponse A JSON response indicating the result of the status change.
     */
    public function status(Request $request)
    {
        $user = Widget::findOrFail($request->id);
        $user->update(['status' => ($user->status == '1' ? '0' : '1')]);
        Cache::forget('media');
        return Response::json([
            'success' => $user->status == '1' ? 'Media Activated Successfully.' : null,
            'error' => $user->status == '0' ? 'Media Deactivated Successfully.' : null,
        ]);
    }
}
