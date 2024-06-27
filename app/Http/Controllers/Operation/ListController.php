<?php

namespace App\Http\Controllers\Operation;

use App\Models\User;
use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ListController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:user list', ['only' => ['index', 'show']]);
        $this->middleware('can:user create', ['only' => ['create', 'store']]);
        $this->middleware('can:user edit', ['only' => ['edit', 'update']]);
        $this->middleware('can:user delete', ['only' => ['destroy']]);
    }
    public function index()
    {
        $users = User::get();
        return Inertia::render('Operation/Asset/List/Index',[
            'users' => $users,
         ]);

    }

    public function destroy($id)
    {
        $data = User::findOrFail($id)->delete();
        return redirect()->route('list.index')->with('success','User deleted successfully.');
    }
}
