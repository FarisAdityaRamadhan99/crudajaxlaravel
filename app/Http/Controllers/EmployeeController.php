<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use App\Models\Employee;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $employee = Employee::all();
        if(request()->ajax()) {
            return DataTables::of($employee)
            ->addColumn('name', function($row) {
                return $row->name;
            })
            ->addColumn('address', function($row) {
                return $row->address;
            })
            ->addColumn('telp', function($row) {
                return $row->telp;
            })
            ->addColumn('aksi', function($employee) {
                
                
                $button = '<a href="javascript:void(0)" data-id="'.$employee->id.'" class="btn btn-sm btn-primary" id="editData" >Edit</a>';
                $button .= '&nbsp;&nbsp;';
                $button .= '<a href="javascript:void(0)" data-id="'.$employee->id.'" class="btn btn-sm btn-danger" id="deleteData">Delete</i></a>';
                
                
                return $button;
            })
            ->rawColumns(['aksi'])
            ->addIndexColumn()
            ->make(true);
        }
        return view('employee');
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
        $request->validate([
            'name'      =>  'required|string|max:225',
            'address'   =>  'required|string|max:225',
            'telp'      =>  'required'
        ]);

        $check = Employee::where('name', $request->name)->first();
        if(!is_null($check)) {
            return response()->json([
                'success'   =>  false,
                'message'   =>  'Data Duplikat'
            ]);
        }

        $check2 = Employee::where('address', $request->address)->first();
        if(!is_null($check2)) {
            return response()->json([
                'success'   =>  false,
                'message'   =>  'Data Duplikat'
            ]);
        }

        $check3 = Employee::where('telp', $request->telp)->first();
        if(!is_null($check3)) {
            return response()->json([
                'success'   =>  false,
                'message'   =>  'Data Duplikat'
            ]);
        }

        $employee = Employee::create($request->all());
        if($employee) {
            return response()->json([
                'success'   =>  true,
                'message'   =>  'Data Berhasil Dibuat'
            ]);
        } else {
            return response()->json([
                'success'   =>  true,
                'message'   =>  'Data Gagal Dibuat'
            ]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $employee = Employee::find($id);
        return response()->json(['result' => $employee]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name'      =>  'required|string|max:255',
            'address'   =>  'required|string|max:255',
            'telp'      =>  'required|string|max:255'
        ]);

        $employee = [
            'name'      =>  $request->name,
            'address'   =>  $request->address,
            'telp'      =>  $request->telp,
        ];

        Employee::where('id', $id)->update($employee);
        return response()->json([
            'success'   =>  true,
            'message'   =>  'Data Berhasil Diupdate',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $employee   =   Employee::findOrFail($id);
        $employee->delete();

        if($employee) {
            return response()->json([
                'success'   =>  true,
                'message'   =>  'Data berhasil dihapus'
            ]);
        } else {
            return response()->json([
                'success'   =>  false,
                'message'   =>  'Data Gagal Dihapus'
            ]);
        }
    }
}
