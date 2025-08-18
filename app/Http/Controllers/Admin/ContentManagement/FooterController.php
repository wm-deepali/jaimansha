<?php

namespace App\Http\Controllers\Admin\ContentManagement;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Models\admin\contentmanagment\FooterInformation;
use App\Models\admin\contentmanagment\HeaderInformation;

class FooterController extends Controller
{

    // 📌 Show all footer records
    public function index()
    {
        $contacts = FooterInformation::orderBy('id', 'desc')->get();
        return view('admin.footer.index', compact('contacts'));
    }

    // 📌 Store new footer info
    public function store(Request $request)
    {
        FooterInformation::create([
            'address' => $request->address ?? '',
            'pincode' => '',
            'email' => $request->email ?? '',
            'mobile' => $request->mobile ?? '',
            'copy_rights' => '',
            'developer_company' => '',
            'developer_url' => '',
            'added_date' => now(),
        ]);

        return redirect()->route('admin.footer.index')->with('success', 'Footer information added.');
    }

    // 📌 Edit view
    public function edit($id)
    {
        $editData = FooterInformation::findOrFail($id);
        $contacts = FooterInformation::orderBy('id', 'desc')->get();
        return view('admin.footer.index', compact('editData', 'contacts'));
    }

public function update(Request $request, $id)
{
    // Footer record leke aao
    $footer = FooterInformation::findOrFail($id);

    // Header record find karo using email (ya better use email or ID)
    $header = HeaderInformation::where('email', $footer->email)->first();

    // Footer update
    $footer->update([
        'address'            => $request->address ?? '',
        'pincode'            => $request->pincode ?? '',
        'email'              => $request->email ?? '',
        'mobile'             => $request->mobile ?? '',
        'copy_rights'        => $request->copy_rights ?? '',
        'developer_company'  => $request->developer_company ?? '',
        'developer_url'      => $request->developer_url ?? '',
        'added_date'         => now(),
    ]);

    // Header update
    if ($header) {
        $header->update([
            'email'           => $request->email ?? '',
            'mobileNumber'    => $request->mobile ?? '',
            'helplineNumber'  => $request->whatsapp ?? '',
        ]);
    }

    return redirect()->route('admin.footer.index')->with('success', 'Footer & Header updated successfully.');
}



    // 📌 Delete record
    public function destroy($id)
    {
        $footer = FooterInformation::findOrFail($id);
        $footer->delete();

        return redirect()->route('admin.footer.index')->with('success', 'Footer information deleted.');
    }
}
