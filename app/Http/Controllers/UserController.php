<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Mail;
use App\Mail\WelcomeEmail;

class UserController extends Controller
{

    /**
     * @return Application|Factory|View
     */
    public function index(Request $request)
    {
        $users = User::query();

        if ($request->has('names')) {
            $users->where('names', 'like', '%' . $request->input('names') . '%');
        }
        if ($request->has('lastName')) {
            $users->where('lastName', 'like', '%' . $request->input('lastName') . '%');
        }
        if ($request->has('document')) {
            $users->where('document', 'like', '%' . $request->input('document') . '%');
        }

        $users = $users->paginate(10);
        return view('users.index', compact('users'));
    }


    /**
     * @return Application|Factory|View
     */
    public function create()
    {
        $categories = Category::all();

        if (Category::count() == 0) {
            Session::flash('error', 'Debe crear al menos una categoria');
            return redirect()->route('categories.create');
        }

        $client = new Client();
        $response = $client->get('https://restcountries.com/v3.1/region/ame');
        $countries = json_decode($response->getBody());


        return view('users.create', compact('countries', 'categories'));
    }


    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'names' => 'required|regex:/^[\pL\s\-]+$/u|min:5|max:100',
            'lastName' => 'required|regex:/^[\pL\s\-]+$/u|max:100',
            'document' => 'required|unique:users|max:10',
            'email' => 'required|unique:users|email|max:150',
            'country' => 'required',
            'category_id' => 'required',
            'address' => 'required|max:180',
            'cellPhone' => 'required|digits:10',
        ]);

        $user = User::create($request->all());

        Mail::to($user->email)->send(new WelcomeEmail($user));

        return redirect()->route('users.index')
            ->with('success', 'Registro creado.');
    }

    /**
     * @param $id
     * @return Application|Factory|View
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('users.edit', compact('user'));
    }


    /**
     * @param Request $request
     * @param $id
     * @return RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $request->validate([
            'names' => 'required|regex:/^[\pL\s\-]+$/u|min:5|max:100',
            'lastName' => 'required|regex:/^[\pL\s\-]+$/u|max:100',
            'document' => 'required|max:10|unique:users,cedula,' . $user->id,
            'email' => 'required|email|max:150|unique:users,email,' . $user->id,
            'country' => 'nullable',
            'category_id' => 'required',
            'address' => 'nullable|max:180',
            'cellPhone' => 'required|digits:10',
        ]);

        $user->update($request->all());

        return redirect()->route('users.index')
            ->with('success', 'Registro actualizado.');
    }

    /**
     * @param $id
     * @return RedirectResponse
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('users.index')->with('success', 'Usuario eliminado correctamente');
    }
}
