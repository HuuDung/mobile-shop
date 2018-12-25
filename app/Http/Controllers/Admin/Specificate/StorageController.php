<?php

namespace App\Http\Controllers\Admin\Specificate;

use App\Http\Requests\SpecificateRequest;
use App\Models\Storage;
use App\Http\Controllers\Controller;

class StorageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $storages = Storage::withTrashed()->paginate(12);
        $data = [
            'title' => "Storages",
            'storages' => $storages,
        ];
        return view('admin.specificate.storage.index', $data);
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
            'title' => "Create Storage",
        ];
        return view('admin.specificate.storage.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @pastorage  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(SpecificateRequest $request)
    {
        $storage = new Storage();
        $storage->fill([
            'storage' => $request->storage,
        ]);
        $storage->save();
        return redirect()->route('admin.specificate.storage.index');
    }

    /**
     * Display the specified resource.
     *
     * @pastorage  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $storage = Storage::findOrFail($id);
        $data = [
            'title' => "Show Storage",
            'storage' => $storage,
        ];
        return view('admin.specificate.storage.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @pastorage  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $storage = Storage::findOrFail($id);
        $data = [
            'title' => "Edit Storage",
            'storage' => $storage,
        ];
        return view('admin.specificate.storage.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @pastorage  \Illuminate\Http\Request $request
     * @pastorage  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(SpecificateRequest $request, $id)
    {
        //
        $storage = Storage::findOrFail($id);
        $storage->update([
            'storage' => $request->storage,
        ]);
        $storage->save();
        return redirect()->route('admin.specificate.storage.show', $storage->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @pastorage  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $storage = Storage::findOrFail($id);
        $storage->delete();
        return redirect()->route('admin.specificate.storage.index');
    }

    public function restore($id)
    {
        $storage = Storage::withTrashed()->findOrFail($id);
        $storage->restore();
        return redirect()->route('admin.specificate.storage.index');
    }
}
