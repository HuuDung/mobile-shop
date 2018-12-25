<?php

namespace App\Http\Controllers\Admin\Specificate;

use App\Http\Requests\SpecificateRequest;
use App\Models\Cpu;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CpuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $cpus =Cpu::withTrashed()->paginate(12);
        $data = [
            'title' => "CPUs",
            'cpus' => $cpus,
        ];
        return view('admin.specificate.cpu.index', $data);
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
            'title' => "Create CPU",
        ];
        return view('admin.specificate.cpu.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(SpecificateRequest $request)
    {
        $cpu = new Cpu();
        $cpu->fill([
            'cpu' => $request->cpu,
        ]);
        $cpu->save();
        return redirect()->route('admin.specificate.cpu.index');
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
        $cpu = Cpu::findOrFail($id);
        $data = [
            'title' => "Show CPU",
            'cpu' => $cpu,
        ];
        return view('admin.specificate.cpu.show', $data);
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
        $cpu = Cpu::findOrFail($id);
        $data = [
            'title' => "Edit CPU",
            'cpu' => $cpu,
        ];
        return view('admin.specificate.cpu.edit', $data);
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
        $cpu = Cpu::findOrFail($id);
        $cpu->update([
            'cpu' => $request->cpu,
        ]);
        $cpu->save();
        return redirect()->route('admin.specificate.cpu.show', $cpu->id);
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
        $cpu = Cpu::findOrFail($id);
        $cpu->delete();
        return redirect()->route('admin.specificate.cpu.index');
    }
    public function restore($id)
    {
        $cpu = Cpu::withTrashed()->findOrFail($id);
        $cpu->restore();
        return redirect()->route('admin.specificate.cpu.index');
    }
}
