<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    // Kullanıcı listesini göster
    public function index()
    {
        $users = User::all();
        return view('users.index', compact('users'));
    }

    // Yeni bir kullanıcı oluşturma formunu göster
    public function create()
    {
        return view('users.create');
    }

    // Yeni bir kullanıcı kaydet
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'surname' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        if ($validator->fails()) {
            return redirect('users/create')
                ->withErrors($validator)
                ->withInput();
        }

        $user = new User([
            'name' => $request->get('name'),
            'surname' => $request->get('surname'),
            'email' => $request->get('email'),
            'password' => Hash::make($request->get('password')),
        ]);

        $user->save();

        return redirect('/users')->with('success', 'Kullanıcı başarıyla eklendi!');
    }

    // Belirli bir kullanıcıyı göster
    public function show($id)
    {
        $user = User::findOrFail($id);
        return view('users.show', compact('user'));
    }

    // Bir kullanıcıyı düzenleme formunu göster
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('users.edit', compact('user'));
    }

    // Bir kullanıcıyı güncelle
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'surname' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,'.$id,
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        if ($validator->fails()) {
            return redirect('users/'.$id.'/edit')
                ->withErrors($validator)
                ->withInput();
        }

        $user = User::findOrFail($id);
        $user->name = $request->get('name');
        $user->surname = $request->get('surname');
        $user->email = $request->get('email');
        if ($request->filled('password')) {
            $user->password = Hash::make($request->get('password'));
        }
        $user->save();

        return redirect('/users')->with('success', 'Kullanıcı başarıyla güncellendi!');
    }

    // Bir kullanıcıyı sil
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect('/users')->with('success', 'Kullanıcı başarıyla silindi!');
    }
}
