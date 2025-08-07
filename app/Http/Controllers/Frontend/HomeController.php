<?php

namespace App\Http\Controllers\Frontend;

use App\Models\{Page, Banner, Photo, Video, PageSection, Admission, Widget};
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\{Cache, Validator, Response};

class HomeController extends Controller
{
    public function index()
    {
        $module_data['banners'] = Cache::rememberForever('banners', function () {
            return Banner::where('status', 1)->get()->take(3);
        });
        $module_data['home_page'] = Page::where('slug', 'home')->first();
        $module_data['about_section'] = PageSection::where('page_id', $module_data['home_page']->id)->where('slug', 'best-of-kids')->first();
        $module_data['unique_offering_section'] = PageSection::where('page_id', $module_data['home_page']->id)->where('slug', 'unique-offerings-at-our-kids-play-school')->first();
        $module_data['why_choose_bachpan'] = PageSection::where('page_id', $module_data['home_page']->id)->where('slug', 'why-choose-dps-hrit-for-your-childs-preschool-journey')->first();
        $module_data['why_choose_bachpan_child'] = PageSection::where('page_id', $module_data['home_page']->id)->where('parent_id', $module_data['why_choose_bachpan']->id)->get();
        $module_data['our_features_programs'] =  PageSection::where('page_id', $module_data['home_page']->id)->where('slug', 'our-feature-programs')->first();
        $module_data['our_features_programs_child'] = PageSection::where('page_id', $module_data['home_page']->id)->where('parent_id', $module_data['our_features_programs']->id)->get();
        return view('frontend.index', compact('module_data'));
    }
    /**
     * Display the about page.
     *
     * Fetches the 'about' page from the database along with its sections
     * and passes the data to the 'frontend.about' view.
     *
     * @return \Illuminate\View\View
     */
    public function about()
    {
        $module_data['about'] = Page::where('slug', 'about')->with('sections')->first();
        return view('frontend.about', compact('module_data'));
    }
    /**
     * Display the photos page.
     *
     * Fetches all the photos which are set to active and passes the
     * data to the 'frontend.photo.photo' view.
     *
     * @return \Illuminate\View\View
     */
    public function photos()
    {
        $module_data['photos'] = Cache::rememberForever('photos', function () {
            return Photo::where('status', 1)->get();
        });
        return view('frontend.photo.photo', compact('module_data'));
    }
    /**
     * Displays the details of a photo.
     *
     * Retrieves the photo with the given slug and its associated images,
     * and returns a view with the photo data.
     *
     * @param string $slug The slug of the photo to display.
     * @return \Illuminate\View\View The view with the photo data.
     */
    public function photoDetails($slug)
    {
        $module_data['photos'] = Photo::where('slug', $slug)->with('photoImages')->first();
        return view('frontend.photo.photo-details', compact('module_data'));
    }
    /**
     * Displays the videos page.
     *
     * Fetches all the videos which are set to active and passes the
     * data to the 'frontend.video' view.
     *
     * @return \Illuminate\View\View
     */
    public function videos()
    {
        $module_data['videos'] = Cache::rememberForever('videos', function () {
            return Video::where('status', 1)->get();
        });
        return view('frontend.video', compact('module_data'));
    }
    /**
     * Displays the media page.
     *
     * Fetches all the media widgets which are set to active and passes the
     * data to the 'frontend.media' view.
     *
     * @return \Illuminate\View\View The view with the media data.
     */
    public function media()
    {
        $module_data['media'] = Widget::where('status', 1)->where('widget_type', 'media')->get();
        return view('frontend.media', compact('module_data'));
    }
    /**
     * Handles the submission of an admission form.
     *
     * Validates the incoming request data for the admission form fields.
     * If validation passes, creates a new Admission record in the database
     * with the provided data. In case of validation failure, returns a JSON
     * response with error details. Returns a success message upon successful
     * creation of the admission. If an exception occurs, catches it and returns
     * a JSON response with an error message.
     *
     * @param \Illuminate\Http\Request $request The HTTP request containing the admission form data.
     * @return \Illuminate\Http\JsonResponse JSON response indicating success or failure of the operation.
     */
    public function admissionSubmit(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'student_name' => 'required|string|min:2|max:50',
                'email' => 'required|email',
                'phone' => 'required',
                'admission_for' => 'required',
            ]);
            if ($validator->fails()) {
                return back()->with('errors', $validator->errors());
            }
            Admission::create([
                // 'country_id' => 101,
                // 'state_id' => $request->state,
                // 'city_id' => $request->city,
                'student_name' => $request->student_name,
                'email' => $request->email,
                'phone' => $request->phone,
                'admission_for' => $request->admission_for,
                'address' => $request->address
            ]);
            return back()->with('success','Addmission Submited Successfully.');
        } catch (\Exception $e) {
            dd($e);
            return back()->with('error','Something went wrong. Please try again.');
        }
    }
}
