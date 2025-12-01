<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Teknisi;

class TeknisisController extends Controller
{
    public function store(Request $request)
    {
        $teknisi = $request->validate([
            'name' => 'required',
            'divisi' => 'required'
        ]);

        Teknisi::create($teknisi);

        return redirect()->back();
    }

    public function delete($id)
    {
        Teknisi::find($id)->delete();

        return redirect()->back();
    }

    public function update(Request $request)
    {
        Teknisi::find($request->id)->update($request->all());

        return redirect()->back();
    }
}
