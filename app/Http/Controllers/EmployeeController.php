<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use App\Models\Employee;

class EmployeeController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employees = Employee::all()->where('created_by', Auth::user()->id);

        //check for empty table
        if (!$employees->isEmpty()) {
            //continue
        } else {
            $employees = 0;
        }
        
        return view('index', compact('employees'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   

        //4.1 Основни полета: имена, адрес, телефон, отдел, длъжност, заплата и други по избор;
        $this->validate($request, [
            'name' => 'required|max:255',
            'email' => 'required|email',
            'address' => 'required|max:500',
            'phone' => 'required|regex:/[0-9]{9}/',
            'department' => 'required|max:255',
            'position' => 'required|max:255',
            'salary' => 'required|regex:/^\d+(\.\d{1,2})?$/'
        ]);

        $data['created_by'] = Auth::user()->id;
        $data['name'] = $request['name'];
        $data['email'] = $request['email'];
        $data['address'] = $request['address'];
        $data['phone'] = $request['phone'];
        $data['department'] = $request['department'];
        $data['position'] = $request['position'];
        $data['salary'] = $request['salary'];

        $show = Employee::create($data);
   
        return redirect('/employees')->with('success', 'Успешно запазихте служител!');
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $employee = Employee::where('created_by', Auth::user()->id)->findOrFail($id);

        return view('edit', compact('employee'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email',
            'address' => 'required|max:500',
            'phone' => 'required|regex:/[0-9]{9}/',
            'department' => 'required|max:255',
            'position' => 'required|max:255',
            'salary' => 'required|regex:/^\d+(\.\d{1,2})?$/'
        ]);

        Employee::whereId($id)->update($validatedData);
   
        return redirect('/employees')->with('success', 'Успешно редактирахте данните!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $employee = Employee::findOrFail($id);
        $employee->delete();

        return redirect('/employees')->with('success', 'Успешно изтрихте служител!');
    }
}
