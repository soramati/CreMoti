<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Models\User;

use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index(User $user)
    {
        return view('Users.index')->with([
            'own_posts' => $user->getOwnPaginateByLimit(),
            'set_goal' => $user->getSetPaginateByLimit()
        ]);
    }
    public function admin(User $user)
    {
        return view('Users.admin')->with([
            'own_posts' => $user->getOwnPaginateByLimit(),
            'set_goal' => $user->getSetPaginateByLimit()
        ]);
    }
    public function reset(User $user)
    {
        $user->resetGoalsSet();

        return redirect('/dashboard');
    }

    public function apiindex(User $user)
    {
        // $memberList = [
        //     ['id' => 1, 'name' => 'hoge'],
        //     ['id' => 2, 'name' => 'fuga'],
        //     ['id' => 3, 'name' => 'piyo'],
        // ];
        // return $memberList;
        $memberList = $user->getSetPaginateByLimit();

        return $memberList;
    }
}
