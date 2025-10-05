<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Settings;
use App\User;
use App\Rules\MatchOldPassword;
use Hash;
use Carbon\Carbon;
use Spatie\Activitylog\Models\Activity;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;
class AdminController extends Controller
{
    public function index(){
        $data = User::select(\DB::raw("COUNT(*) as count"), \DB::raw("DAYNAME(created_at) as day_name"), \DB::raw("DAY(created_at) as day"))
        ->where('created_at', '>', Carbon::today()->subDay(6))
        ->groupBy('day_name','day')
        ->orderBy('day')
        ->get();
     $array[] = ['Name', 'Number'];
     foreach($data as $key => $value)
     {
       $array[++$key] = [$value->day_name, $value->count];
     }
     
     // Get visitor statistics
     $visitorStats = [
         'today_visits' => \App\Models\Visitor::getTodayVisits(),
         'today_unique_visitors' => \App\Models\Visitor::getTodayUniqueVisitors(),
         'this_week_visits' => \App\Models\Visitor::getThisWeekVisitors(),
         'this_month_visits' => \App\Models\Visitor::getThisMonthVisitors(),
         'all_time_unique_visitors' => \App\Models\Visitor::getAllTimeUniqueVisitors(),
         'all_time_total_visits' => \App\Models\Visitor::getAllTimeTotalVisits(),
         'last_7_days' => \App\Models\Visitor::getLast7DaysVisitors()
     ];
     
     return view('backend.index')
         ->with('users', json_encode($array))
         ->with('visitorStats', $visitorStats);
    }

    public function profile(){
        $profile=Auth()->user();
        // return $profile;
        return view('backend.users.profile')->with('profile',$profile);
    }

    public function profileUpdate(Request $request,$id){
        // return $request->all();
        $user=User::findOrFail($id);
        $data=$request->all();
        
        // Restrict co-admin from changing their role
        if($user->role == 'co-admin' && isset($data['role'])) {
            unset($data['role']); // Remove role from data to prevent changes
        }
        
        $status=$user->fill($data)->save();
        if($status){
            request()->session()->flash('success','Successfully updated your profile');
        }
        else{
            request()->session()->flash('error','Please try again!');
        }
        return redirect()->back();
    }

    public function settings(){
        $data=Settings::first();
        return view('backend.setting')->with('data',$data);
    }

    public function settingsUpdate(Request $request){
        // return $request->all();
        $this->validate($request,[
            'short_des'=>'required|string',
            'hero_slogan'=>'nullable|string|max:255',
            'presentation_image'=>'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:92160', // 90MB
            'about_hero_bg'=>'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:92160', // 90MB
            'about_presentation_image'=>'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:92160',
            'about_mission_image'=>'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:92160',
            'about_objectives_image'=>'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:92160',
            'about_expertise_image'=>'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:92160',
            'about_approach_image'=>'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:92160',
            'address'=>'required|string',
            'email'=>'required|email',
            'phone'=>'required|string',
            'warranty_years'=>'required|integer|min:1|max:50',
            'experience_years'=>'required|integer|min:1|max:100',
            'projects_count'=>'required|integer|min:1|max:1000',
        ]);
        
        $data = $request->only(['short_des', 'hero_slogan', 'address', 'email', 'phone', 'warranty_years', 'experience_years', 'projects_count']);
        
        // Handle presentation image upload
        if ($request->hasFile('presentation_image')) {
            $settings = Settings::first();
            
            // Delete old presentation image file if it exists
            if ($settings->presentation_image && file_exists(public_path($settings->presentation_image))) {
                @unlink(public_path($settings->presentation_image));
            }
            
            $file = $request->file('presentation_image');
            $filename = uniqid() . '.' . $file->getClientOriginalExtension();
            
            // Create directory if it doesn't exist
            $uploadPath = public_path('images/presentation');
            if (!file_exists($uploadPath)) {
                mkdir($uploadPath, 0755, true);
            }
            
            // Move file to public directory (creates a copy)
            $file->move($uploadPath, $filename);
            $data['presentation_image'] = 'images/presentation/' . $filename;
        }

        // Handle About Us hero background upload
        if ($request->hasFile('about_hero_bg')) {
            $settings = Settings::first();

            if ($settings->about_hero_bg && file_exists(public_path($settings->about_hero_bg))) {
                @unlink(public_path($settings->about_hero_bg));
            }

            $file = $request->file('about_hero_bg');
            $filename = uniqid() . '.' . $file->getClientOriginalExtension();

            $uploadPath = public_path('images/about-us');
            if (!file_exists($uploadPath)) {
                mkdir($uploadPath, 0755, true);
            }

            $file->move($uploadPath, $filename);
            $data['about_hero_bg'] = 'images/about-us/' . $filename;
        }

        // Handle About Us section images uploads
        $sectionFields = [
            'about_presentation_image',
            'about_mission_image',
            'about_objectives_image',
            'about_expertise_image',
            'about_approach_image',
        ];

        foreach ($sectionFields as $field) {
            if ($request->hasFile($field)) {
                $settings = Settings::first();
                if ($settings->{$field} && file_exists(public_path($settings->{$field}))) {
                    @unlink(public_path($settings->{$field}));
                }

                $file = $request->file($field);
                $filename = uniqid() . '.' . $file->getClientOriginalExtension();
                $uploadPath = public_path('images/about-us');
                if (!file_exists($uploadPath)) {
                    mkdir($uploadPath, 0755, true);
                }
                $file->move($uploadPath, $filename);
                $data[$field] = 'images/about-us/' . $filename;
            }
        }
        
        $settings = Settings::first();
        $status = $settings->fill($data)->save();
        
        if($status){
            request()->session()->flash('success','Paramètres mis à jour avec succès');
        }
        else{
            request()->session()->flash('error','Veuillez réessayer');
        }
        return redirect()->route('admin');
    }

    public function changePassword(){
        return view('backend.layouts.changePassword');
    }
    public function changPasswordStore(Request $request)
    {
        $request->validate([
            'current_password' => ['required', new MatchOldPassword],
            'new_password' => ['required', 'min:8', 'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]/'],
            'new_confirm_password' => ['required', 'same:new_password'],
        ], [
            'new_password.regex' => 'Password must contain at least one uppercase letter, one lowercase letter, one number, and one special character.',
            'new_password.min' => 'Password must be at least 8 characters long.',
            'new_confirm_password.same' => 'Password confirmation does not match.',
            'new_confirm_password.required' => 'Password confirmation is required.',
        ]);

        User::find(auth()->user()->id)->update(['password'=> Hash::make($request->new_password)]);

        return redirect()->route('home')->with('success','Password successfully changed');
    }

    // Pie chart
    public function userPieChart(Request $request){
        // dd($request->all());
        $data = User::select(\DB::raw("COUNT(*) as count"), \DB::raw("DAYNAME(created_at) as day_name"), \DB::raw("DAY(created_at) as day"))
        ->where('created_at', '>', Carbon::today()->subDay(6))
        ->groupBy('day_name','day')
        ->orderBy('day')
        ->get();
     $array[] = ['Name', 'Number'];
     foreach($data as $key => $value)
     {
       $array[++$key] = [$value->day_name, $value->count];
     }
    //  return $data;
     return view('backend.index')->with('course', json_encode($array));
    }

    // public function activity(){
    //     return Activity::all();
    //     $activity= Activity::all();
    //     return view('backend.layouts.activity')->with('activities',$activity);
    // }

    public function storageLink(){
        // check if the storage folder already linked;
        if(File::exists(public_path('storage'))){
            // removed the existing symbolic link
            File::delete(public_path('storage'));

            //Regenerate the storage link folder
            try{
                Artisan::call('storage:link');
                request()->session()->flash('success', 'Successfully storage linked.');
                return redirect()->back();
            }
            catch(\Exception $exception){
                request()->session()->flash('error', $exception->getMessage());
                return redirect()->back();
            }
        }
        else{
            try{
                Artisan::call('storage:link');
                request()->session()->flash('success', 'Successfully storage linked.');
                return redirect()->back();
            }
            catch(\Exception $exception){
                request()->session()->flash('error', $exception->getMessage());
                return redirect()->back();
            }
        }
    }
}
