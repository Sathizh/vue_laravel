<?php

namespace App\Http\Controllers;

use App\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function getContact()
    {
        $contacts=Contact::all();
        return $contacts;
    }
    public function save_contact(Request $request)
    {
        $contact = new Contact;
        if($request->has('image') && !empty($request->image)){
            $imageName = time().'.'.$request->image->getClientOriginalExtension();
            $request->image->move(public_path('images/gallery'),$imageName);
            $path=('images/gallery/'.$imageName);
            $contact->image=$path;
        }else{
            $contact->image="images/gallery/noimage.jpg";

        }
        $contact->name=$request->name;
        $contact->email=$request->email;
        $contact->designation=$request->designation;
        $contact->bio=$request->bio;
        $contact->contact_no=$request->contact_no;

        if($contact->save()){
            return \response()->json(['status'=>true,'message'=>'contact Added Successfully']);
        }else{
            return \response()->json(['status'=>false,'message'=>'Something went wrong try after some more minuts']);
        }

    }
    public function deleteContaact($id)
    {
        $contact=Contact::find($id);
        if($contact->delete()){
            return \response()->json(['status'=>true,'message'=>'contact Deleted Successfully']);
        }else{
            return \response()->json(['status'=>false,'message'=>'Something went wrong try after some more minuts']);
        }
    }
    public function search_contact($id)
    {
        $contact=Contact::find($id);
        return \response()->json($contact);

    }
    public function update_contact(Request $request,$id)
    {

        $contact =Contact::where('id',$id)->first();
        // if($request->has('image') && !empty($request->image)){
        //     $imageName = time().'.'.$request->image->getClientOriginalExtension();
        //     $request->image->move(public_path('images/gallery'),$imageName);
        //     $path=('images/gallery/'.$imageName);
        //     $contact->image=$path;
        // }else{
        //     $contact->image="images/gallery/noimage.jpg";

        // }
        $contact->name=$request->name;
        $contact->email=$request->email;
        $contact->designation=$request->designation;
        $contact->bio=$request->bio;
        $contact->contact_no=$request->contact_no;

        if($contact->save()){
            return \response()->json(['status'=>true,'message'=>'contact Updated Successfully']);
        }else{
            return \response()->json(['status'=>false,'message'=>'Something went wrong try after some more minuts']);
        }

    }
}
