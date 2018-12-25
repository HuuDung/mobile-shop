<?php

namespace App\Http\Controllers\Admin\Specificate;

use App\Http\Requests\SpecificateRequest;
use App\Http\Controllers\Controller;
use App\Models\System;

class SystemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $systems =System::withTrashed()->paginate(12);

        $data = [
            'title' => "Systems",
            'systems' => $systems,
        ];
        return view('admin.specificate.system.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $data = [
            'title' => "Create System",
        ];
        return view('admin.specificate.system.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @pasystem  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(SpecificateRequest $request)
    {
        $system = new System();
        $system->fill([
            'system' => $request->system,
        ]);
        $system->save();
        return redirect()->route('admin.specificate.system.index');
    }

    /**
     * Display the specified resource.
     *
     * @pasystem  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $system = System::findOrFail($id);
        $data = [
            'title' => "Show System",
            'system' => $system,
        ];
        return view('admin.specificate.system.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @pasystem  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $system = System::findOrFail($id);
        $data = [
            'title' => "Edit System",
            'system' => $system,
        ];
        return view('admin.specificate.system.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @pasystem  \Illuminate\Http\Request $request
     * @pasystem  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(SpecificateRequest $request, $id)
    {
        //
        $system = System::findOrFail($id);
        $system->update([
            'system' => $request->system,
        ]);
        $system->save();
        return redirect()->route('admin.specificate.system.show', $system->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @pasystem  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $system = System::findOrFail($id);
        $system->delete();
        return redirect()->route('admin.specificate.system.index');
    }
    public function restore($id)
    {
        $system = System::withTrashed()->findOrFail($id);
        $system->restore();
        return redirect()->route('admin.specificate.system.index');
    }
}
