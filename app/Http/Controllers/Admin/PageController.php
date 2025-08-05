<?php

namespace App\Http\Controllers\Admin;

use App\Models\Page;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\{Validator, Response};

class PageController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.page.index');
    }
    /**
     * Display a listing of the resource in Datatable.
     *
     * @param \Illuminate\Http\Request $request The request containing the Datatable parameters.
     * @return \Illuminate\Http\JsonResponse A JSON response with the Datatable data.
     */
    public function ajaxTable(Request $request)
    {
        $pages = Page::get();
        return Datatables::of($pages)
            ->addIndexColumn()
            ->editColumn('title', function ($data) {
                return ucfirst($data->title);
            })
            ->addColumn('action', function ($data) {
                return '<a href="' . route('pages.edit', $data->id) . '" class="btn btn-sm btn-primary text-white"><i class="ri-edit-line"></i></a>';
            })
            ->rawColumns(['title', 'action'])
            ->make(true);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.page.create');
    }
    /**
     * Store a newly created page resource in storage.
     *
     * This method validates the incoming request data for a page title, ensuring it is unique
     * and meets the specified character limits. If validation fails, it returns a JSON response
     * with error messages. If the validation passes, it creates a new page with the provided
     * title, category, and subcategory, and redirects to the page index with a success message.
     * If an exception occurs during the process, it catches the exception and returns back to
     * the form with an error message.
     *
     * @param \Illuminate\Http\Request $request The incoming request instance.
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'title' => 'required|string|min:2|max:50|unique:pages,title',
            ]);
            if ($validator->fails()) {
                return back()->with('errors',$validator->errors()->first());
            }
            Page::create([
                'parent_id' => $request->parent_id ?? 0,
                'title' => $request->title,
            ]);
            return redirect(route('pages.index'))->with('success', 'Page Created Successfully.');
        } catch (\Exception $e) {
            dd($e);
            return back()->with('error', __('Something went wrong. Please try again.'));
        }
    }
    /**
     * Display the specified page resource.
     *
     * @param  string  $slug
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $module_data = Page::with('parent')->findOrFail($id);
        return view('admin.page.edit', compact('module_data'));
    }
    /**
     * Updates a page resource.
     *
     * Validates the request data and attempts to update the page.
     * If the validation fails, it redirects back with an error message.
     * If the update fails, it redirects back with an error message.
     * If the page is updated successfully, it redirects to the page list view with a success message.
     *
     * @param \Illuminate\Http\Request $request The request data.
     * @param int $id The ID of the page to update.
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {
        try {
            $validator = Validator::make($request->all(), [
                'title' => 'required|string|min:2|max:50|unique:pages,title,' . $id,
            ]);
            if ($validator->fails()) {
                return back()->with('error', $validator->errors()->first());
            }
            $page = Page::find($id);
            $page->parent_id = $request->parent_id;
            $page->title = $request->title;
            $page->save();
            return redirect(route('pages.index'))->with('success', 'Page Updated Successfully.');
        } catch (\Exception $e) {
            return back()->with('error', __('Something went wrong. Please try again.'));
        }
    }
    /**
     * Check if the page title is unique.
     *
     * This method validates the uniqueness of a page title. If a `page_id` is present
     * in the request, it excludes the current entry from the uniqueness check.
     * The method returns a JSON response indicating whether the validation passed.
     *
     * @param \Illuminate\Http\Request $request The incoming request containing the page title and optional page_id.
     * @return \Illuminate\Http\JsonResponse A JSON response with a boolean indicating if the title is unique.
     */
    public function checkUnique(Request $request)
    {
        $page_id = $request->input('page_id');
        $rules = [
            'title' => $page_id ? 'unique:pages,title,' . $page_id . ',id' : 'unique:pages,title',
        ];
        $validator = Validator::make($request->all(), $rules);
        return Response::json(!$validator->fails());
    }
}
