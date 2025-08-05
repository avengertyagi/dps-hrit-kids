<?php

namespace App\Http\Controllers\Admin;

use App\Models\Banner;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\{Validator, File, Cache, Response};

class BannerController extends Controller
{
    /**
     * Show the banner page.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.banner.index');
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
        $banners = Banner::when($status !== null, function ($query) use ($status) {
            return $query->where('status', '=', $status);
        });
        return Datatables::of($banners)
            ->addIndexColumn()
            ->editColumn('status', function ($data) {
                $checked = $data->status ? 'checked' : '';
                return '<div class="form-check form-switch">
                            <input type="checkbox" class="form-check-input status-switch" id="switch-' . $data->id . '" ' . $checked . '>
                            <label class="form-check-label" for="switch-' . $data->id . '"></label>
                        </div>';
            })
            ->editColumn('image', function ($item) {
                $path = asset($item->image) ?? 'assets/backend/images/picture.png';
                $image = "<a href='$path' data-fancybox='gallery'><img src='$path' width='80px' height='50px' alt='image' class='img-fluid avatar-md rounded'></a>";
                return $image;
            })
            ->addColumn('action', function ($data) {
                $action = "";
                $action .= '<a href="' . route('banners.edit', $data->id) . '" title="Edit" class="btn btn-sm btn-info"><i class="ri-edit-2-line"></i></a> ';
                return $action;
            })
            ->rawColumns(['status', 'action', 'image'])
            ->make(true);
    }
    /**
     * Displays the edit banner form.
     *
     * Retrieves the banner with the given ID and returns a view with the banner data.
     *
     * @param int $id The ID of the banner to edit.
     * @return \Illuminate\Contracts\View\View The edit banner form view.
     */
    public function edit($id)
    {
        $module_data = Banner::findOrFail($id);
        return view('admin.banner.edit', compact('module_data'));
    }
    /**
     * Updates a banner resource.
     *
     * Validates the request data and attempts to upload the thumbnail image.
     * If the validation fails, it redirects back with an error message.
     * If the upload fails, it redirects back with an error message.
     * If the banner is updated successfully, it redirects to the banner list view with a success message.
     *
     * @param \Illuminate\Http\Request $request The request data.
     * @param int $id The ID of the banner to update.
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
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
            $banner = Banner::find($id);
            if ($request->hasFile('image')) {
                try {
                    if ($banner->iamge && File::exists(public_path($banner->image))) {
                        File::delete(public_path($banner->image));
                    }
                    $image = imageUpload($request->file('image'), 'uploads/banner');
                } catch (\Exception $e) {
                    return back()->with('error', 'Could not upload your file: ' . $e->getMessage());
                }
            }
            $banner->update([
                'title' => $request->title,
                'image' => $image
            ]);
            Cache::forget('banners');
            return redirect()->route('banners.index')->with('success', __('Banner Updated Successfully'));
        } catch (\Exception $e) {
            dd($e);
            return back()->with('error', __('Something went wrong. Please try again.'));
        }
    }
    /**
     * Toggles the status of the specified banner between active and inactive.
     *
     * Retrieves the banner with the given ID, toggles its status between '1' (active) and '0' (inactive),
     * and returns a JSON response with a success message if the status is changed to active
     * or an error message if it is changed to inactive.
     *
     * @param \Illuminate\Http\Request $request The request containing the ID of the banner.
     * @return \Illuminate\Http\JsonResponse A JSON response indicating the result of the status change.
     */
    public function status(Request $request)
    {
        $user = Banner::findOrFail($request->id);
        $user->update(['status' => ($user->status == '1' ? '0' : '1')]);
        Cache::forget('banners');
        return Response::json([
            'success' => $user->status == '1' ? __('Banner Activated Successfully.') : null,
            'error' => $user->status == '0' ? __('Banner Deactivated Successfully.') : null,
        ]);
    }
}
