<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCompanyRequest;
use App\Http\Requests\UpdateCompanyRequest;
use App\Models\Company;
use Yajra\DataTables\Facades\DataTables;

class CompanyController extends Controller
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
        return view('company.index');
    }

    public function list()
    {
        return Datatables::of(Company::query())
            ->addColumn('id', function ($company) {
                return '<a href="/companies/'. $company->id .'">'. $company->id .'</a>';
            })
            ->addColumn('logo', function ($company) {
                $url = asset('storage/logo/'.$company->logo);
                return '<img width="100" height="100" src="'. $url .'" alt="'. $company->logo.'"/>';
            })
            ->addColumn('action', function ($company) {
                $editUrl = route('companies.edit',$company->id);
                $delUrl = route('companies.destroy',$company->id);
                $csrf = csrf_field();
                $deleteMethod = method_field("DELETE");
                $x = <<<EOD
                    <a class="btn" href="$editUrl">
                    Edit</i>
                    </a>
                    <form action="$delUrl" method="POST">
                    $csrf
                    $deleteMethod
                    <button type="submit" class="btn btn-danger"
                        onclick="return confirm('Are You Sure Want to Delete?')">Delete</a>
                    </form>
                EOD;
                return $x;
            })
            ->rawColumns(['id', 'logo','action'])
            ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('company.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreCompanyRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCompanyRequest $request)
    {
        $fileName = sprintf("%s_%s", $request->input('name'), $request->file('logo')->getClientOriginalName());
        $path = $request->file('logo')->storeAs(
            'public/logo',
            $fileName
        );

        $company = new Company;
        $company->name = $request->name;
        $company->email = $request->email;
        $company->logo = $fileName;
        $company->website = $request->website;
        $company->save();

        return redirect()->route('companies.index')
            ->with('success','Company inserted successfully');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function show(Company $company)
    {
        return view('company.show',compact('company'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function edit(Company $company)
    {
        return view('company.edit', compact('company'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCompanyRequest  $request
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCompanyRequest $request, Company $company)
    {
        $validated = $request->safe()->only(['name', 'email', 'website']);
        if ($request->file('logo')) {
            $fileName = sprintf("%s_%s", $request->input('name'), $request->file('logo')->getClientOriginalName());
            $path = $request->file('logo')->storeAs(
                'public/logo',
                $fileName
            );
            $validated['logo'] = $fileName;
        }
        $company->update($validated);

        return redirect()->route('companies.index')
            ->with('success','Company updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function destroy(Company $company)
    {
        $company->delete();

        return redirect()->route('companies.index')
            ->with('success','Company deleted successfully');
    }
}
