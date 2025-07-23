<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Category;
use App\Models\Answer;
use App\Models\Content;
use App\Models\Wallet;
use App\Models\Prompt;
use Illuminate\Support\Facades\Validator;
use App\Models\Role;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use App\Traits\ToolsTrait;
use App\Traits\ImageUpload;
use App\Models\Files;
use Symfony\Component\HttpFoundation\StreamedResponse;


class ProfileController extends Controller
{
    use ToolsTrait, ImageUpload;
    
    public function profileIndex()
    {
        $getUserDetails = Auth::guard('user')->user();
        $getUserWallet = Wallet::where('user_id',$getUserDetails)->first();

        return view('users.profile.index', compact('getUserDetails','getUserWallet'));
    }


    public function profileUpdate(Request $request)
    {
        $getUser = User::where('id',$request->userId)->first();
        if(!empty($getUser)){
            if(!empty($request->name)){
                $getUser->name = $request->name;
                $getUser->save();
            }
            if(!empty($request->email)){
                $getUser->email = $request->email;
                $getUser->save();
            }
            Session::flash('success', "Profile updated successfully");
            return redirect()->back();
        }
        Session::flash('error', "Error updating profile");
        return redirect()->back();
    }


    // public function profileDelete(Request $request)
    // {
    //     $getUser = User::where('id',$request->userId)->first();
    //     if(!empty($getUser)){
    //         $randomString = '_deleted_at_' . time() . Str::random(8);
    //         $getUser->email = $getUser->email . $randomString;
    //         $getUser->discord_id = $getUser->discord_id . $randomString;
    //         $getUser->save();
    //         $getUser->delete();

    //         Session::flash('success', "Profile deleted successfully");
    //         return response()->json(['status' => 'success', 'message' => 'User Deleted Successfully.'], 200);
    //     }
    //     Session::flash('error', "Error deleting profile");
    //     return response()->json(['status' => 'failed', 'message' => 'Error deleting profile.'], 400);
    // }

    public function profileDelete(Request $request)
    {
        $getUser = User::where('id', $request->userId)->first();
        if (!empty($getUser)) {
            $randomString = '_deleted_at_' . time() . Str::random(8);
            $getUser->email = $getUser->email . $randomString;
            $getUser->discord_id = $getUser->discord_id . $randomString;
            $getUser->save();
            $getUser->delete();

            Session::flash('success', "Profile deleted successfully");
            return response()->json([
                'status' => 'success', 
                'message' => 'User Deleted Successfully.',
                'redirect_url' => route('getHomePage') // Provide the URL for redirection
            ], 200);
        }
        Session::flash('error', "Error deleting profile");
        return response()->json([
            'status' => 'failed', 
            'message' => 'Error deleting profile.'
        ], 400);
    }




    public function profileUpload(Request $request)
    {
        $getUser = User::where('id', $request->userId)->first();
        if ($getUser) {
            if ($request->hasFile('profile_picture')) {
                $file = $this->UploadImage($request->file('profile_picture'), Files::FOLDER_USER);
                $getUser->profile_image = $file;
                $getUser->save();
                Session::flash('success', "Profile picture updated successfully");
                return response()->json([
                    'status' => 'success',
                    'message' => 'Profile picture updated successfully',
                ], 200);
            } else {
                Session::flash('error', "Error uploading profile image");
                return response()->json([
                    'status' => 'failed',
                    'message' => 'Error uploading profile image.'
                ], 400);
            }
        } else {
            Session::flash('error', "Error uploading profile image");
            return response()->json([
                'status' => 'failed',
                'message' => 'Error uploading profile image.'
            ], 400);
        }
    }




    // public function profileUpload(Request $request)
    // {
    //     $getUser = User::where('id', $request->userId)->first();
    //     if (!empty($getUser)) {
    //         if (!empty($request->profile_picture)) {
    //             $checkForImage = $getUser->profile_image;
    //             // if(($checkForImage != NULL)){
    //             //     $file = $this->UploadImage($request->profile_picture, Files::FOLDER_USER,$checkForImage);
    //             //     $getUser->profile_image = $file;
    //             //     $getUser->save();
    //             // }else{
    //                 // dd($request->profile_picture);
    //                 $file = $this->UploadImage($request->profile_picture, Files::FOLDER_USER);
    //                 $getUser->profile_image = $file;
    //                 $getUser->save();
    //             // } 
    //             Session::flash('success', "Profile picture updated successfully");
    //             return response()->json([
    //                 'status' => 'success', 
    //                 'message' => 'Profile picture updated successfully',
    //             ], 200);
    //         }else{
    //             Session::flash('error', "Error uploading profile image");
    //             return response()->json([
    //                 'status' => 'failed', 
    //                 'message' => 'Error uploading profile image.'
    //             ], 400);
    //         }
            
    //     }else{
    //         Session::flash('error', "Error uploading profile image");
    //         return response()->json([
    //             'status' => 'failed', 
    //             'message' => 'Error uploading profile image.'
    //         ], 400);
    //     }
        
    // }
    
}
