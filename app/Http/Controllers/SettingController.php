<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function privacy(){
         $content=Setting::where("name","privacy")->first();
         if(!$content){
            $content=new Setting();
            $content->name="privacy";
            $content->value="privacy";
            $content->save();

         }

        return view("admin.privacy",compact('content'));
    }

    public function privacySave(){
        $content=Setting::where("name","privacy")->first();
        if($content){
        
           $content->value=request("value");
           $content->save();

        }

       return redirect()->back()->with("success","Privacy Policy Content Updated Successfully");
   }

   public function terms(){
    $content=Setting::where("name","terms")->first();
    if(!$content){
       $content=new Setting();
       $content->name="terms";
       $content->value="terms";
       $content->save();

    }

   return view("admin.terms",compact('content'));
}

public function termsSave(){
   $content=Setting::where("name","terms")->first();
   if($content){
   
      $content->value=request("value");
      $content->save();

   }

  return redirect()->back()->with("success","Terms & Conditions Content Updated Successfully");
}
}