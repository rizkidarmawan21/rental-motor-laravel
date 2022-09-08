<?php

namespace App\Http\Controllers;

use App\Models\Motor;
use App\Http\Requests\StoreMotorRequest;
use App\Models\Sewa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MotorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $motors = Motor::all();
        return view('pages.motor.index', compact('motors'));
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
     * @param  \App\Http\Requests\StoreMotorRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreMotorRequest $request)
    {
        $validation = $request->all();
        if ($request->hasFile('image_motor')) {
            $image_path = $request->file('image_motor')->store('assets/image_motor', 'public');
            $validation['image_motor'] = $image_path;
        }
        $validation['status'] = 0; // status 0 = tersedia , 1 = sedang disewakan

        Motor::create($validation);
        return redirect()->route('motor.index')->with('success', 'addConfirm();');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Motor  $motor
     * @return \Illuminate\Http\Response
     */
    public function show(Motor $motor)
    {
        return view('pages.motor.detail', compact('motor'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Motor  $motor
     * @return \Illuminate\Http\Response
     */
    public function edit(Motor $motor)
    {
        return view('pages.motor.edit', compact('motor'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateMotorRequest  $request
     * @param  \App\Models\Motor  $motor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Motor $motor)
    {
        if ($request->hasFile('image_motor')) {
            $image_motor  = 'image|mimes:jpeg,bmp,png,jpg';
        } else {
            $image_motor = '';
        }

        $validation = $request->validate([
            'image_motor'  => $image_motor,
            'nama'         => 'required|max:225',
            'kategori'     => 'required|max:225',
            'catatan'      => 'required',
            'harga'        => 'required',
            'no_polisi'    => $request->no_polisi === $motor->no_polisi ? '' : 'unique:motors'
        ]);

        if ($request->hasFile('image_motor')) {
            $image_path = $request->file('image_motor')->store('assets/image_motor', 'public');
            $validation['image_motor'] = $image_path;
            Storage::delete($motor->image_motor);
        }


        $motor->update($validation);
        return redirect()->route('motor.index')->with('success', 'editConfirm();');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Motor  $motor
     * @return \Illuminate\Http\Response
     */
    public function destroy(Motor $motor)
    {
        Storage::delete($motor->image_motor);
        $motor->delete();
        Sewa::destroy(['motor_id'=>$motor->id]);
        return redirect()->route('motor.index')->with('success', 'destroyMessage();');
    }
}
