<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\Forum;
use App\Models\Admin;


class ForumController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function index()
    {
        $forums = Forum::select(
            'forum.id',
            'forum.admin_id',
            'users.username',
            'admin.username as admin_username',
            'forum.level',
            'forum.title',
            'forum.detail',
            'forum.time_date'
        )
        ->leftJoin('users', 'forum.user_id', '=', 'users.id')
        ->leftJoin('admin', 'forum.admin_id', '=', 'admin.id')
        ->get();

        return view('Admin.Forum.index', ['forums' => $forums]);
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
     * @param  \App\Models\forum  $forum
     * @return \Illuminate\Http\Response
     */
    public function show(forum $forum)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\forum  $forum
     * @return \Illuminate\Http\Response
     */
    public function edit(forum $forum)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\forum  $forum
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, forum $forum)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\forum  $forum
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $forum = Forum::find($id);

        if (!$forum) {
            // Handle the case where the post with the given ID is not found
            abort(404);
        }

        $forum->delete();
        return redirect()->to('dashboard/forum');
    }
    public function detail(Request $request)
    {

        return view('Admin.Forum.detail');
    }
    public  function save(Request $request){
        // $admin_id=Admin::find(session()->get('id'))->id;
        $data = [
            'user_id' => null,
            'admin_id' =>Admin::find(session()->get('id'))->id,
            'level' => 0,
            'title' => $request->input('title'),
            'detail' => $request->input('detail'),
        ];

        try {
            $forum = forum::create($data);
        } catch (\Exception $e) {
            throw new \Exception('UNEXPECTED_ERROR_MESSAGE');
        }
        return redirect()->to('dashboard/forum/detail');

    }
}
