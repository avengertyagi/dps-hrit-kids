<?php

namespace App\Http\Controllers\Admin;

use App\Models\PageSection;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\{Validator, Response};

class PageSectionController extends Controller
{
    /**
     * Display a listing of the page sections.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        return view('admin.page-section.index');
    }
    /**
     * Display a listing of the resource in Datatable.
     *
     * @param \Illuminate\Http\Request $request The request containing the Datatable parameters.
     * @return \Illuminate\Http\JsonResponse A JSON response with the Datatable data.
     */
    public function ajaxTable(Request $request)
    {
        $page_id = $request->input('page_id');
        $page_sections = PageSection::with('page','parent')
            ->when($page_id, function ($query) use ($page_id) {
                return $query->where('page_id', '=', $page_id);
            });
        return Datatables::of($page_sections)
            ->addIndexColumn()
            ->order(function ($query) {
                if (request()->has('order')) {
                    $order = request()->input('order');
                    switch ($order[0]['column']) {
                        case 2:
                            $query->orderBy('page_id', $order[0]['dir']);
                            break;
                        default:
                            $query->orderBy('created_at', 'desc');
                            break;
                    }
                } else {
                    $query->orderBy('created_at', 'desc');
                }
            })
            ->filter(function ($query) use ($request) {
                if ($request->has('search') && !empty($request->search['value'])) {
                    $searchValue = $request->search['value'];
                    $query->where(function ($q) use ($searchValue) {
                        $q->whereHas('page', function ($q) use ($searchValue) {
                            $q->where('title', 'like', "%$searchValue%");
                        })->orWhere('section_title', 'like', "%$searchValue%");
                    });
                }
            })
            ->addColumn('page_name', function ($data) {
                return ucfirst($data->page->title ?? 'NA');
            })
            ->editColumn('parent_section', function ($data) {
                return ucfirst($data->parent->section_title ?? 'NA');
            })
            ->editColumn('featured_image', function ($item) {
                $path = $item->featured_image ? asset($item->featured_image) : asset('assets/backend/images/picture.png');
                $image = "<a href='$path' data-fancybox='gallery'><img src='$path' width='80px' height='50px' alt='image' class='img-fluid avatar-md rounded'></a>";
                return $image;
            })
            ->editColumn('section_title', function ($data) {
                return ucfirst($data->section_title);
            })
            ->addColumn('action', function ($data) {
                return '<a href="' . route('page-sections.edit', $data->id) . '" class="btn btn-sm btn-primary text-white"><i class="ri-edit-line"></i></a>';
            })
            ->rawColumns(['section_title', 'action', 'featured_image', 'page_name','parent_section'])
            ->make(true);
    }
    /**
     * Show the form for creating a new page section.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function create()
    {
        return view('admin.page-section.create');
    }
    /**
     * Store a newly created page section in storage.
     *
     * Validates the request data and attempts to create a page section.
     * If the validation fails, it returns a JSON response with error messages.
     * If the page section is created successfully, it redirects to the page section index with a success message.
     * If an exception occurs, it catches the exception and redirects back with an error message.
     *
     * @param \Illuminate\Http\Request $request The request containing the page section data.
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        //dd($request->all());
        try {
            $validator = Validator::make($request->all(), [
                'section_title' => 'required|string|min:2|max:100|unique:page_sections,section_title',
                'section_name' => 'required',
                'description' => 'nullable',
                'page_id' => 'required|exists:pages,id',
            ]);
            if ($validator->fails()) {
                return back()->with('error', $validator->errors());
            }
            $featured_image = null;
            if ($request->hasFile('image')) {
                try {
                    $featured_image = imageUpload($request->file('image'), 'uploads/page_section');
                } catch (\Exception $e) {
                    return back('error', __('Could not upload your file: ' . $e->getMessage()));
                }
            }
            PageSection::create([
                'parent_id' => $request->parent_id ?? 0,
                'page_id' => $request->page_id ?? 0,
                'section_title' => $request->section_title,
                'section_name' => Str::lower($request->section_name),
                'featured_image' => $featured_image,
                'content' => $request->description,
                'sort_order' => $request->sort_order ?? 0,
            ]);
            return redirect(route('page-sections.index'))->with('success', 'Page Section Created Successfully');
        } catch (\Exception $e) {
            dd($e);
            return back()->with('error', __('Something went wrong. Please try again.'));
        }
    }
    /**
     * Display the specified page section for editing.
     *
     * This method fetches the page section with the given ID and its associated page and parent page section.
     * If the page section is found, it renders the edit view for the page section.
     * If the page section is not found, it throws a 404 error.
     *
     * @param int $id The ID of the page section to edit.
     * @return \Illuminate\Contracts\View\View The edit view for the page section.
     */
    public function edit($id)
    {
        $module_data = PageSection::with('page', 'parent')->findOrFail($id);
        return view('admin.page-section.edit', compact('module_data'));
    }
    /**
     * Updates a page section in storage.
     *
     * Validates the request data and attempts to update a page section.
     * If the validation fails, it redirects back with an error message.
     * If the page section is updated successfully, it redirects to the page section index with a success message.
     * If an exception occurs, it catches the exception and redirects back with an error message.
     *
     * @param \Illuminate\Http\Request $request The request containing the page section data.
     * @param int $id The ID of the page section to update.
     * @return \Illuminate\Http\RedirectResponse Redirect response upon success or failure.
     */
    public function update(Request $request, $id)
    {
        try {
            $validator = Validator::make($request->all(), [
                'section_title' => 'required|string|min:2|max:100|unique:page_sections,section_title,' . $id,
                'section_name' => 'required',
                'description' => 'nullable',
                'page_id' => 'required|exists:pages,id',
            ]);
            if ($validator->fails()) {
                return back()->with('error', $validator->errors()->first());
            }
            $page_section = PageSection::find($id);
            $featured_image = $page_section->featured_image;
            if ($request->hasFile('image')) {
                try {
                    $featured_image = imageUpload($request->file('image'), 'uploads/page_section');
                } catch (\Exception $e) {
                    return back('error', __('Could not upload your file: ' . $e->getMessage()));
                }
            }
            $page_section->update([
                'parent_id' => $request->parent_id ?? 0,
                'page_id' => $request->page_id ?? 0,
                'section_title' => $request->section_title,
                'section_name' => Str::lower($request->section_name),
                'featured_image' => $featured_image,
                'content' => $request->description,
                'sort_order' => $request->sort_order ?? 0,
            ]);
            return redirect(route('page-sections.index'))->with('success', 'Page Section Updated Successfully');
        } catch (\Exception $e) {
            return back()->with('error', __('Something went wrong. Please try again.'));
        }
    }
    /**
     * Check if the page section title is unique.
     *
     * This method validates the uniqueness of a page section title. If a `page_id` is present
     * in the request, it excludes the current entry from the uniqueness check.
     * The method returns a JSON response indicating whether the validation passed.
     *
     * @param \Illuminate\Http\Request $request The incoming request containing the section title and optional page_id.
     * @return \Illuminate\Http\JsonResponse A JSON response with a boolean indicating if the section title is unique.
     */
    public function checkUnique(Request $request)
    {
        $page_section_id = $request->input('page_section_id');
        $rules = [
            'section_title' => $page_section_id ? 'unique:page_sections,section_title,' . $page_section_id . ',id' : 'unique:page_sections,section_title',
        ];
        $validator = Validator::make($request->all(), $rules);
        return Response::json(!$validator->fails());
    }
}
