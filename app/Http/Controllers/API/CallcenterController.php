<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Callcenter;

class CallcenterController extends Controller
{
  public function get_all_contacts()
  {
    $contacts = Callcenter::orderBy('id', 'ASC')->get();

    return response()->json([
      'contacts' => $contacts
    ], 200);
  }

  public function create_contact(Request $request)
  {
    $this->validate($request, [
      'assignment' => 'required'
    ]);

    $callcenter = new Callcenter();   
    $callcenter->image = $request->image;
    $callcenter->assignment = $request->assignment;
    $callcenter->city = $request->city;
    $callcenter->street = $request->street;
    $callcenter->number = $request->number;
    $callcenter->personone = $request->personone;
    $callcenter->phoneone = $request->phoneone;
    $callcenter->emailone = $request->emailone;
    $callcenter->persontwo = $request->persontwo;
    $callcenter->phonetwo = $request->phonetwo;
    $callcenter->emailtwo = $request->emailtwo;
    $callcenter->emergency = $request->emergency;
    $callcenter->keywords = $request->keywords;


    $callcenter->save();
      return response()->json(['success' => 'Callcenter created successfully.']);
  }

  public function delete_contact(Request $request)
  {
    $this->validate($request, [
      'id' => 'required'
    ]);

    Callcenter::where('id', $request->id)->delete();
    return response()->json([
      'id' => $request->id,
      'deleted' => true
    ], 200);
  }

  public function update_contact(Request $request)
  {
    $this->validate($request, [
      'id' => 'required',
      'image' => 'required',
      'assignment' => 'required',
      'city' => 'required',
      'street' => 'required',
      'number' => 'required',
      'personone' => 'required',
      'phoneone' => 'required',
      'emailone' => 'required',
      'persontwo' => 'required',
      'phonetwo' => 'required',
      'emailtwo' => 'required',
      'emergency' => 'required',
      'keywords' => 'required',
    ]);

    $updated = [     
      'image' => $request->image,
      'assignment' => $request->assignment,
      'city' => $request->city,
      'street' => $request->street,
      'number' => $request->number,
      'personone' => $request->personone,
      'phoneone' => $request->phoneone,
      'emailone' => $request->emailone,
      'persontwo' => $request->persontwo,
      'phonetwo' => $request->phonetwo,
      'emailtwo' => $request->emailtwo,
      'emergency' => $request->emergency,
      'keywords' => $request->keywords,
    ];

    Callcenter::where('id', $request->id)->update($updated);
    $contact = Callcenter::where('id', $request->id)->get();
    return response()->json([
      'contact' => $contact[0],
      'updated' => true
    ], 200);
  }
}
