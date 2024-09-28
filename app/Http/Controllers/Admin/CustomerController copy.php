<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class CustomerController extends Controller {

    public function index() {

        $customers = User::where( 'role', 'customer' )->get();
        return view( 'admin.customers.index', compact( 'customers' ) );
    }

    public function create() {
        return view( 'admin.customers.create' );
    }

    public function store( Request $request ) {
        $request->validate( [
            'name'    => 'required|string|max:255',
            'email'   => 'required|email|unique:users,email',
            'phone'   => 'nullable|string|max:15',
            'address' => 'nullable|string|max:255',
        ] );

        User::create( [
            'name'    => $request->name,
            'email'   => $request->email,
            'phone'   => $request->phone,
            'address' => $request->address,
            'role'    => 'customer',
        ] );

        return redirect()->route( 'admin.customers.index' )->with( 'status', 'Customer created successfully!' );
    }

    public function show( $id ) {
        $customer = User::where( 'role', 'customer' )->findOrFail( $id );
        return view( 'admin.customers.show', compact( 'customer' ) );
    }

    public function edit( $id ) {
        $customer = User::where( 'role', 'customer' )->findOrFail( $id );
        return view( 'admin.customers.edit', compact( 'customer' ) );
    }

    public function destroy( $id ) {
        $customer = User::where( 'role', 'customer' )->findOrFail( $id );
        $customer->delete();

        return redirect()->route( 'admin.customers.index' )->with( 'status', 'Customer deleted successfully!' );
    }

    public function update( Request $request, $id ) {

        $customer = User::where( 'role', 'customer' )->findOrFail( $id );

        $request->validate( [
            'name'    => 'required|string|max:255',
            'email'   => 'required|email|unique:users,email,' . $customer->id,
            'phone'   => 'nullable|string|max:15',
            'address' => 'nullable|string|max:255',
        ] );

        $customer->update( [
            'name'    => $request->input( 'name' ),
            'email'   => $request->input( 'email' ),
            'phone'   => $request->input( 'phone' ),
            'address' => $request->input( 'address' ),
        ] );

        return redirect()->route( 'customers.index' )->with( 'status', 'Customer updated successfully!' );
    }

    public function history( $id ) {
        $customer = User::where( 'role', 'customer' )->findOrFail( $id );
        return view( 'admin.customers.history', compact( 'customer' ) );
    }

}
