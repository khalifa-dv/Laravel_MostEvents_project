<?php

namespace App\Http\Controllers;
use App\Models\Oner;
use Illuminate\Support\Facades\DB;
use Storage;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Http\Request;

class OnerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Oner $oner)
        {if ($oner->isOner()){
            
        return view('oner.show_manager',compact('oner'));

        }
        return view('Oner.show',compact('oner'));
        }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Oner $oner)
    {
        return view('oner.edit',compact('oner'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
      
        $oner= Oner::find($id);
        if(!empty($oner->id)){
            
            $request->validate([
                'name' => "required|string|min:5|max:100",
                'email' => "required|email|min:5|max:100|unique:oners,id,".$oner->id,
                'phone' => "required|numeric|min:7",
                'adress' => "required",
                'logo' => "nullable|mimes:jpg,jpeg,png|image|max:2048"
            ]);
            if(!empty($request->file('logo'))){
                $path = Storage::putFile('public',$request->file('logo'));
                $url = Storage::url($path);
                $oner->logo = $url;
            }
            $oner->name = $request->name;
            $oner->places = $request->places;
            
            $oner->save();
            $user = User::find(auth()->id());
            $user->email = $request->email;
            $user->adress = $request->adress;
            $user->phone = $request->phone;
            $user->save();
        }
      
        return redirect()->back();
   
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}