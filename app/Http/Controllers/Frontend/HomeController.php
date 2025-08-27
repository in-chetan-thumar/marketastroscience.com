<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\EnquiryRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        return view('frontend.home');
    }

    public function getDistricts(Request $request)
    {
        $data = $districts = [];
        try {
            $stateId = $request->state_id;
            if ($stateId) {
                // Fetch districts based on the state
                $districts = resolve('common-helper')->districtListByState($stateId);
                $data['success'] = true;
                $data['data'] = $districts;
                return response()->json($data);
            }
            $data['success'] = false;
            $data['message'] = 'State id not found!';
            return response()->json($data);
        } catch (\Exception $e) {
            $data['success'] = false;
            $data['message'] = app('common-helper')->generateErrorMessage($e);
            return response()->json($data);
        }
    }

    public function enquiryStore(EnquiryRequest $request)
    {
        try {
            $data = $params = [];
            DB::beginTransaction();
            $params['name'] = $request->name;
            $params['number'] = $request->number;
            $params['email'] = $request->email;
            $params['master_state_id'] = $request->master_state_id;
            $params['master_tehsil_id'] = $request->master_tehsil_id;
            $enquiry = resolve('enquiry-repo')->create($params);
            if (!empty($enquiry)) {
                $data['error'] = false;
                $data['message'] = 'Enquiry submitted successfully.';
                DB::commit();
                return response()->json($data);
            }
            $data['error'] = true;
            $data['message'] = 'Enquiry not submitted successfully..!';
            return response()->json($data);
            ;
        } catch (\Exception $e) {
            DB::rollBack();
            $data['error'] = true;
            $data['message'] = resolve('common-helper')->generateErrorMessage($e);
            return response()->json($data);
        }
    }

    public function viewBlog($slug = null)
    {
        $params = $params_for_all_blogs = [];
        $states = resolve('common-helper')->stateList();
        $params = ['is_active' => 'Y'];
        if ($slug) {
            $params['slug'] = $slug;
            $blog = resolve('b-blog-repo')->filter($params)->first(); // Fetch single blog
        } else {
            $blog = null; // If no slug, set blog as null
        }
        $params_for_all_blogs['is_active'] = 'Y';

        // Fetch other blogs excluding the current blog (if slug is provided)
        $other_blogs = resolve('b-blog-repo')->filter($params_for_all_blogs)
            ->orderBy('blog_date')
            ->when($slug, function ($query) use ($slug) {
                return $query->whereNot('slug', $slug); // Exclude current blog
            })->get();
        // dd($other_blogs, $blog);
        return view('frontend.blogs', compact('other_blogs', 'blog', 'states'));
    }

}
