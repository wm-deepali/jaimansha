<?php

namespace App\Http\Controllers\Admin\Settings;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\admin\setting\AccountSetting;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class AccountSettingController extends Controller
{
    // 1. Show all records
    public function index()
    {
        $accounts = AccountSetting::all();
        return view('admin.settings.account', compact('accounts'));
    }

    // 2. Show form to create new
    public function create()
    {
        return view('admin.settings.account.create');
    }

    // 3. Store new record
    public function store(Request $request)
    {
        $request->validate([
            'username' => 'required|email|unique:authentication,username',
            'password' => 'required',
            'status' => 'required'
        ]);

        AccountSetting::create([
            'username' => $request->username,
            'password' => md5($request->password),
            'status' => $request->status,
            'admin_added' => now(),
        ]);

        return redirect()->route('admin.account.index')->with('success', 'Account created successfully.');
    }

    // 4. Show edit form
    public function edit($id)
    {
        $account = AccountSetting::findOrFail($id);
        return view('admin.settings.account.edit', compact('account'));
    }

    // 5. Update existing record
    public function update(Request $request, $id)
    {
        $account = AccountSetting::findOrFail($id);

        $request->validate([
            'username' => 'required|email|unique:authentication,username,' . $id,
            'status' => 'required'
        ]);

        $account->username = $request->username;
        if ($request->password) {
            $account->password = md5($request->password);
        }
        $account->status = $request->status;
        $account->save();

        return redirect()->route('admin.account.index')->with('success', 'Account updated successfully.');
    }

    // 6. Delete record
    public function destroy($id)
    {
        AccountSetting::findOrFail($id)->delete();
        return redirect()->route('admin.account.index')->with('success', 'Account deleted successfully.');
    }

    // 7. Show login form
    public function showLoginForm()
{
    return view('admin.auth.login');
}


public function login(Request $request)
{
    // 1. Validate the inputs
    $request->validate([
        'username' => 'required|string',
        'password' => 'required|string'
    ]);

    $credentials = $request->only('username', 'password');

    // 2. Find the active user record
    $user = AccountSetting::where('username', $credentials['username'])
        ->where('status', 'active')
        ->first();
        
    // 3. Verify the password (choose correct method depending on how it's stored)
    if ($user) {
        // If password is stored using Laravel's Hash
        if (Hash::check($credentials['password'], $user->password)) {
        // Manual session set karo ya Auth facade use karo
        session(['admin_user' => $user->id]);
            return redirect()->route('admin.dashboard');
        }
    }
    
    // 4. If login fails
    return back()->withErrors([
        'username' => 'Invalid username or password, or inactive account.'
    ]);
}


public function logout(Request $request)
{
    // session forget or Auth logout
    session()->forget('admin_user');
    // Auth::guard('admin')->logout();

    return redirect()->route('admin.account.login')->with('success', 'Logged out successfully.');
}

public function showChangePasswordForm()
{
    return view('admin.account.change_password');
}

public function changePassword(Request $request)
{
    $validator = Validator::make($request->all(), [
        'current_password' => 'required',
        'new_password' => 'required|min:5',
        'confirm_password' => 'required|same:new_password'
    ]);

    $id = session('admin_user');

    if (!$id) {
        session()->flash('error', 'Unauthenticated admin user.');
        return redirect()->back();
    }

    $admin = AccountSetting::find($id);

    if (!$admin) {
        session()->flash('error', 'Admin user not found.');
        return redirect()->back();
    }

    if ($validator->fails()) {
        return redirect()->back()->withErrors($validator)->withInput();
    }

    // ✅ Password match check (sahi logic)
    if (Hash::check($request->current_password, $admin->password)) {
        session()->flash('error', 'Your current password is incorrect.');
        return redirect()->back();
    }

    // ✅ Password update
    $admin->password = Hash::make($request->new_password);
    $admin->save();

    session()->flash('success', 'Password changed successfully.');
    return redirect()->back();
}



}
