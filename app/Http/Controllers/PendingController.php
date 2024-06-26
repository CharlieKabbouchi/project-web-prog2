<?php

namespace App\Http\Controllers;

use App\Models\Pending;
use Illuminate\Http\Request;

class PendingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Pending $pending)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pending $pending)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pending $pending)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy( $pending)
    
    {
        $pending=Pending::findOrFail( $pending);
        $pending->delete();
        return redirect(route('viewpendteacher'));
    }
}
