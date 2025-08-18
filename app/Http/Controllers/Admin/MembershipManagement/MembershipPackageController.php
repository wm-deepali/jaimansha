<?php

namespace App\Http\Controllers\Admin\MembershipManagement;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\admin\membership\Package as ManagePackage;

class MembershipPackageController extends Controller
{
    public function index()
    {
        $packages = ManagePackage::all();
        return view('admin.membership.packages.index', compact('packages'));
    }

    public function create()
    {
        return view('admin.membership.packages.create');
    }

    public function show($id)
{
    $page = ManagePackage::findOrFail($id);
    return view('admin.membership.page.show', compact('page'));
}

    public function store(Request $request)
    {
        $request->validate([
            'package_name' => 'required|string',
            'amount' => 'required|numeric',
            'duration' => 'required|string',
            'description' => 'nullable|string',
        ]);

        ManagePackage::create($request->all());

        return redirect()->route('admin.membership.packages.index')->with('success', 'Package created successfully!');
    }

    public function edit($id)
    {
        $package = ManagePackage::findOrFail($id);
        return view('admin.membership.packages.edit', compact('package'));
    }

    public function update(Request $request, $id)
    {
        $package = ManagePackage::findOrFail($id);

        $request->validate([
            'package_name' => 'required|string',
            'amount' => 'required|numeric',
            'duration' => 'required|string',
            'description' => 'nullable|string',
        ]);

        $package->update($request->all());

        return redirect()->route('admin.membership.packages.index')->with('success', 'Package updated successfully!');
    }

    public function destroy($id)
    {
        ManagePackage::findOrFail($id)->delete();
        return redirect()->route('admin.membership.packages.index')->with('success', 'Package deleted!');
    }
}
