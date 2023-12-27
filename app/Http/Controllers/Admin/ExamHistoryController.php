<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\Exam_history;

class ExamHistoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param  \App\Models\exam_history  $exam_history
     * @return \Illuminate\Http\Response
     */
    public function show(exam_history $exam_history)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\exam_history  $exam_history
     * @return \Illuminate\Http\Response
     */
    public function edit(exam_history $exam_history)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\exam_history  $exam_history
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, exam_history $exam_history)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\exam_history  $exam_history
     * @return \Illuminate\Http\Response
     */
    public function destroy(exam_history $exam_history)
    {
        //
    }
}
