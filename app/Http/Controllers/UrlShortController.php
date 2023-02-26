<?php

namespace App\Http\Controllers;

use App\Models\Link;
use Illuminate\Http\Request;


class UrlShortController extends Controller
{

public function form()
{
    return view('home');
}

public function getData($id)
{
    $link = Link::findOrFail($id);

    if (now()->gt($link->expired)) {
        session()->flash('error', 'Qısa linkin vaxtı bitib.');

        return view('shortLink', [
            'link' => $link
        ]);
    }
   
    $link->increment('click_count');
    sleep(5);
    return redirect($link->long_url, 302);
}


     public function store(Request $request)
    {
       
        $validatedData = $request->validate([
            'orgLink' => 'required|url'
        ]);

        $expDate = $request->expiredDate ?? 90;
        $orgLink = $validatedData['orgLink'];
       
        $myShortLink;
        $newDate = now()->addDays($expDate);
       
       
       

        $link = Link::where('long_url', $orgLink)->first();

        if (!$link) {
            $uniqueId = uniqid();
            $myShortLink = substr(hash('sha256', $uniqueId), 0, 10);
         

            $link=Link::create([
              'long_url' => $orgLink,
              'short_url' => $myShortLink,
              'expired' => $newDate
            ]);
        }
        else{
            $myShortLink = Link::orderBy('created_at','DESC')->first()->short_url;
            $link = Link::where('long_url', $orgLink)->first();
        }
        
            

        return view('shortLink', [
                'link' => $link
        ]);

  
      }



}
