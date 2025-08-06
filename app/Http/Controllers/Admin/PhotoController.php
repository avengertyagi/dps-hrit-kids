<?php

namespace App\Http\Controllers\Admin;

use App\Models\{PhotoImage, Photo};
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Yajra\Datatables\Datatables;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\{Validator, DB, File, Response,Cache};

class PhotoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.photo.index');
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
        $photos = Photo::when($status !== null, function ($query) use ($status) {
            return $query->where('status', '=', $status);
        });
        return Datatables::of($photos)
            ->addIndexColumn()
            ->editColumn('status', function ($data) {
                $checked = $data->status ? 'checked' : '';
                return '<div class="form-check form-switch">
                            <input type="checkbox" class="form-check-input status-switch" id="switch-' . $data->id . '" ' . $checked . '>
                            <label class="form-check-label" for="switch-' . $data->id . '"></label>
                        </div>';
            })
            ->editColumn('thumbnail_image', function ($item) {
                $path = asset($item->thumbnail_image) ?? 'assets/backend/images/picture.png';
                $image = "<a href='$path' data-fancybox='gallery'><img src='$path' width='80px' height='50px' alt='image' class='img-fluid avatar-md rounded'></a>";
                return $image;
            })
            ->addColumn('action', function ($data) {
                $action = "";
                $action .= '<a href="' . route('photos.edit', $data->id) . '" title="Edit" class="btn btn-sm btn-info"><i class="ri-edit-2-line"></i></a> ';
                $action .= '<a href="' . route('photos.show', $data->id) . '" title="View" class="btn btn-sm btn-primary"><i class="ri-eye-line"></i></a>';
                return $action;
            })
            ->rawColumns(['status', 'action', 'thumbnail_image'])
            ->make(true);
    }
    /**
     * Displays the create photo form.
     *
     * This function is a basic route that displays the create photo form view.
     * It is not expected to be used directly, but rather as a route for use in a controller.
     *
     * @return \Illuminate\Contracts\View\View The create photo form view.
     */
    public function create()
    {
        return view('admin.photo.create');
    }
    /**
     * Stores a new photo resource.
     *
     * Validates the request data and attempts to upload the thumbnail image.
     * If the validation fails, it redirects back with an error message.
     * If the upload fails, it redirects back with an error message.
     * If the photo is created successfully, it redirects to the photo list view with a success message.
     *
     * @param \Illuminate\Http\Request $request The request data.
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $validator = Validator::make($request->all(), [
                'title' => 'required|string|min:2|max:50|unique:photos,title',
                'thumbnail_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);
            if ($validator->fails()) {
                return back()->with('error', $validator->errors()->first());
            }
            if ($request->hasFile('thumbnail_image')) {
                try {
                    $thumbnail_image = imageUpload($request->file('thumbnail_image'), 'uploads/photo');
                } catch (\Exception $e) {
                    return back()->with('error', 'Could not upload your file: ' . $e->getMessage());
                }
            }
            $photo = Photo::create([
                'title' => $request->title,
                'thumbnail_image' => $thumbnail_image,
            ]);
            $images = $request->input('final_images', []);
            if (is_array($images) && !empty($images)) {
                $imageData = [];
                foreach ($images as $image) {
                    $tmpPath = public_path('uploads/tmp/photo/' . $image);
                    $finalDir = public_path('uploads/photo/images');
                    $finalPath = $finalDir . '/' . $image;
                    if (!is_dir($finalDir)) {
                        mkdir($finalDir, 0755, true);
                    }
                    if (File::exists($tmpPath)) {
                        File::move($tmpPath, $finalPath);
                        $imageData[] = [
                            'photo_id' => $photo->id,
                            'image' => 'uploads/photo/images/' . $image,
                            'created_at' => Carbon::now(),
                            'updated_at' => Carbon::now(),
                        ];
                        File::delete($tmpPath);
                    }
                }
            } else {
                DB::rollBack();
                return back()->with('error', __('Could not created'));
            }
            if (!empty($imageData)) {
                collect($imageData)->chunk(10)->each(function ($chunk) {
                    PhotoImage::insert($chunk->toArray());
                });
            }
            DB::commit();
            Cache::forget('photos');
            return redirect()->route('photos.index')->with('success', __('Photo Created Successfully'));
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', __('Something went wrong. Please try again.'));
        }
    }
    /**
     * Displays the edit photo form.
     *
     * Retrieves the photo with the given ID and returns a view with the photo data.
     *
     * @param int $id The ID of the photo to edit.
     * @return \Illuminate\Contracts\View\View The edit photo form view.
     */
    public function edit($id)
    {
        $module_data = Photo::with('photoImages')->findOrFail($id);
        return view('admin.photo.edit', compact('module_data'));
    }
    /**
     * Updates a photo resource.
     *
     * Validates the request data and attempts to upload the thumbnail image.
     * If the validation fails, it redirects back with an error message.
     * If the upload fails, it redirects back with an error message.
     * If the photo is updated successfully, it redirects to the photo list view with a success message.
     *
     * @param \Illuminate\Http\Request $request The request data.
     * @param int $id The ID of the photo to update.
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {
        DB::beginTransaction();
        try {
            $validator = Validator::make($request->all(), [
                'title' => 'required|string|min:2|max:50|unique:photos,title,' . $id,
                'thumbnail_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);
            if ($validator->fails()) {
                return back()->with('error', $validator->errors()->first());
            }
            $photo = Photo::findOrFail($id);
            if ($request->hasFile('thumbnail_image')) {
                try {
                    if ($photo->thumbnail_image && File::exists(public_path($photo->thumbnail_image))) {
                        File::delete(public_path($photo->thumbnail_image));
                    }
                    $thumbnail_image = imageUpload($request->file('thumbnail_image'), 'uploads/video/thumbnail');
                    $photo->thumbnail_image = $thumbnail_image;
                } catch (\Exception $e) {
                    return back()->with('error', 'Could not upload your file: ' . $e->getMessage());
                }
            }
            $photo->title = $request->title;
            $photo->save();
            $images = $request->input('final_images', []);
            $image_ids = $request->input('image_id', []);
            if (is_array($images) && !empty($images)) {
                $imageData = [];
                foreach ($images as $key => $image) {
                    $imageId = $image_ids[$key] ?? null;
                    $tmpPath = public_path('uploads/tmp/photo/' . $image);
                    $finalDir = public_path('uploads/photo/images');
                    $finalPath = $finalDir . '/' . $image;
                    if (!is_dir($finalDir)) {
                        mkdir($finalDir, 0755, true);
                    }
                    if (File::exists($tmpPath)) {
                        File::move($tmpPath, $finalPath);
                        if ($imageId) {
                            PhotoImage::where('photo_id', $photo->id)
                                ->where('id', $imageId)
                                ->update(['image' => 'uploads/photo/images/' . $image]);
                        } else {
                            $imageData[] = [
                                'photo_id' => $photo->id,
                                'image' => 'uploads/photo/images/' . $image,
                                'created_at' => Carbon::now(),
                                'updated_at' => Carbon::now(),
                            ];
                        }
                        File::delete($tmpPath);
                    }
                }
                if (!empty($imageData)) {
                    collect($imageData)->chunk(10)->each(function ($chunk) {
                        PhotoImage::insert($chunk->toArray());
                    });
                }
            }
            if (!empty($request->deleted_ids)) {
                $deletedIds = explode(',', $request->deleted_ids[0]);
                foreach ($deletedIds as $deleteId) {
                    $photoImage = PhotoImage::find($deleteId);
                    if ($photoImage) {
                        if (File::exists(public_path($photoImage->image))) {
                            File::delete(public_path($photoImage->image));
                        }
                        $photoImage->delete();
                    }
                }
            }
            DB::commit();
            Cache::forget('photos');
            return redirect()->route('photos.index')->with('success', __('Photo Updated Successfully'));
        } catch (\Exception $e) {
            dd($e);
            DB::rollBack();
            return back()->with('error', __('Something went wrong. Please try again.'));
        }
    }
    /**
     * Displays the specified photo.
     *
     * Retrieves the photo with the given ID and its associated images,
     * and returns a view with the photo data.
     *
     * @param int $id The ID of the photo to display.
     * @return \Illuminate\Http\Response The view with the photo data.
     */
    public function show($id)
    {
        $module_data = Photo::with('photoImages')->findOrFail($id);
        return view('admin.photo.view',compact('module_data'));
    }
    /**
     * Toggles the status of the specified staff user between active and inactive.
     *
     * Retrieves the staff user with the given ID, toggles its status between '1' (active) and '0' (inactive),
     * and returns a JSON response with a success message if the status is changed to active
     * or an error message if it is changed to inactive.
     *
     * @param \Illuminate\Http\Request $request The request containing the ID of the staff user.
     * @return \Illuminate\Http\JsonResponse A JSON response indicating the result of the status change.
     */
    public function status(Request $request)
    {
        $user = Photo::findOrFail($request->id);
        $user->update(['status' => ($user->status == '1' ? '0' : '1')]);
        Cache::forget('photos');
        return Response::json([
            'success' => $user->status == '1' ? __('Photo Activated Successfully.') : null,
            'error' => $user->status == '0' ? __('Photo Deactivated Successfully.') : null,
        ]);
    }
    /**
     * Check if the photo title is unique.
     *
     * This method validates the uniqueness of a photo title. If a `staff_id` is present
     * in the request, it excludes the current entry from the uniqueness check. 
     * The method returns a JSON response indicating whether the validation passed.
     *
     * @param \Illuminate\Http\Request $request The incoming request containing the photo title and optional staff_id.
     * @return \Illuminate\Http\JsonResponse A JSON response with a boolean indicating if the title is unique.
     */
    public function checkUnique(Request $request)
    {
        $photo_id = $request->input('photo_id');
        $rules = [
            'title' => $photo_id ? 'unique:photos,title,' . $photo_id . ',id' : 'unique:photos,title',
        ];
        $validator = Validator::make($request->all(), $rules);
        return response()->json(!$validator->fails());
    }
    /**
     * Handles the AJAX request for uploading a temporary photo.
     *
     * This function receives a file from an AJAX request and saves it to the
     * public/uploads/tmp/photo directory. It returns the filename of the uploaded
     * image as a JSON response.
     *
     * @param Request $request The incoming HTTP request containing the photo file.
     * @return \Illuminate\Http\JsonResponse A JSON response containing the filename of the uploaded image.
     */
    public function uploadTmp(Request $request)
    {
        try {
            $file = $request->file('files');
            $imageName = Str::uuid() . '.' . $file->getClientOriginalExtension();
            $publicPath = public_path('uploads/tmp/photo/');
            if (!is_dir($publicPath)) {
                mkdir($publicPath, 0755, true);
            }
            $file->move($publicPath, $imageName);
            return Response::json(['success' => true, 'images' => $imageName]);
        } catch (\Exception $e) {
            dd($e);
            return Response::json(['error' => __('Something went wrong. Please try again.' . $e->getMessage())]);
        }
    }
}
