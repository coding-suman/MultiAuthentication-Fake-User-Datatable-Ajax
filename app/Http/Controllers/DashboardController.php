<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class DashboardController extends Controller
{
    public function index(){
        return view('dashboard');
    }

    public function adminDashboard(){
        return view('admin.dashboard');
    }

    public function getUserList(Request $request){
        return view('admin.userList');
    }

    // Fetch users for DataTable
    public function getUserData(Request $request)
    {
        if ($request->ajax()) {
            $users = User::where('role', 'user')->select(['id', 'name', 'email', 'created_at']);

            return DataTables::of($users)
                ->addIndexColumn() // Adds the DT_RowIndex on the client-side
                ->editColumn('created_at', function ($user) {
                    return \Carbon\Carbon::parse($user->created_at)
                        ->timezone(config('app.timezone')) // Apply Laravel timezone
                        ->format('d-m-Y h:i:s A'); // Format date-time
                })
                ->addColumn('action', function ($row) {
                    return '<a href="#" class="btn btn-primary btn-sm">Edit</a>';
                })
                // ->rawColumns(['action'])
                ->make(true);
        }
    }
}
