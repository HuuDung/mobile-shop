<?php

namespace App\Http\Controllers\Admin\Specificate;

use App\Http\Requests\SpecificateRequest;
use App\Models\Ram;
use App\Http\Controllers\Controller;

class RamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $rams =Ram::withTrashed()->paginate(12);
        $data = [
            'title' => "Rams",
            'rams' => $rams,
        ];
        return view('admin.specificate.ram.index', $data);
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
            'title' => "Create Ram",
        ];
        return view('admin.specificate.ram.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(SpecificateRequest $request)
    {
        $ram = new Ram();
        $ram->fill([
            'ram' => $request->ram,
        ]);
        $ram->save();
        return redirect()->route('admin.specificate.ram.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $ram = Ram::findOrFail($id);
        $data = [
            'title' => "Show Ram",
            'ram' => $ram,
        ];
        return view('admin.specificate.ram.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $ram = Ram::findOrFail($id);
        $data = [
            'title' => "Edit Ram",
            'ram' => $ram,
        ];
        return view('admin.specificate.ram.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(SpecificateRequest $request, $id)
    {
        //
        $ram = Ram::findOrFail($id);
        $ram->update([
            'ram' => $request->ram,
        ]);
        $ram->save();
        return redirect()->route('admin.specificate.ram.show', $ram->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $ram = Ram::findOrFail($id);
        $ram->delete();
        return redirect()->route('admin.specificate.ram.index');
    }
    public function restore($id)
    {
        $ram = Ram::withTrashed()->findOrFail($id);
        $ram->restore();
        return redirect()->route('admin.specificate.ram.index');
    }
}
