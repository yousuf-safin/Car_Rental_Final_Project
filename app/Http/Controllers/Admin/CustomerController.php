<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Rental;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CustomerController extends Controller {

    protected $user;

    public function __construct( User $user ) {
        $this->user = $user;
    }

    public function index() {

        $customers = $this->user->where( 'role', 'customer' )->get();
        return view( 'admin.customers.index', compact( 'customers' ) );
    }

    public function create() {
        return view( 'admin.customers.create' );
    }

    public function store( Request $request ) {
        $validatedData = $request->validate( [
            'name'    => 'required|string|max:255',
            'email'   => 'required|email|unique:users,email',
            'phone'   => 'nullable|string|max:15',
            'address' => 'nullable|string|max:255',
        ] );

        $this->user->create( array_merge( $validatedData, ['role' => 'customer'] ) );

        return redirect()->route( 'admin.customers.index' )->with( 'status', 'Customer created successfully!' );
    }

    public function show( $id ) {
        $customer = $this->findCustomer( $id );
        return view( 'admin.customers.show', compact( 'customer' ) );
    }

    public function edit( $id ) {
        $customer = $this->findCustomer( $id );
        return view( 'admin.customers.edit', compact( 'customer' ) );
    }

    public function update( Request $request, $id ) {
        $customer = $this->findCustomer( $id );

        $validatedData = $request->validate( [
            'name'    => 'required|string|max:255',
            'email'   => 'required|email|unique:users,email,' . $customer->id,
            'phone'   => 'nullable|string|max:15',
            'address' => 'nullable|string|max:255',
        ] );

        $customer->update( $validatedData );

        return redirect()->route( 'customers.index' )->with( 'status', 'Customer updated successfully!' );
    }

    public function destroy( $id ) {
        $customer = $this->findCustomer( $id );
        $customer->delete();

        return redirect()->route( 'customers.index' )->with( 'status', 'Customer deleted successfully!' );
    }

    public function history( $userId ) {

        $customer = $this->findCustomer( $userId );

        $currentRentals = Rental::where( 'user_id', $userId )
            ->where( 'end_date', '>=', Carbon::now() )
            ->get();

        $pastRentals = Rental::where( 'user_id', $userId )
            ->where( 'end_date', '<', Carbon::now() )
            ->get();

        return view( 'admin.customers.history', compact( 'currentRentals', 'pastRentals', 'customer' ) );

    }

    protected function findCustomer( $id ) {
        return $this->user->where( 'role', 'customer' )->findOrFail( $id );
    }
}
