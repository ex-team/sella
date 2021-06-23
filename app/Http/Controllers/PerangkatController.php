<?php

namespace App\Http\Controllers;

use App\Exports\PerangkatExport;
use App\Http\Requests;
use App\Http\Requests\CreatePerangkatRequest;
use App\Http\Requests\UpdatePerangkatRequest;
use App\Repositories\PerangkatRepository;
use App\Http\Controllers\AppBaseController as InfyOmBaseController;
use App\Imports\PerangkatImport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;
use App\Models\Perangkat;
use Flash;
use Maatwebsite\Excel\Facades\Excel;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class PerangkatController extends InfyOmBaseController
{
    /** @var  PerangkatRepository */
    private $perangkatRepository;

    public function __construct(PerangkatRepository $perangkatRepo)
    {
        $this->perangkatRepository = $perangkatRepo;
    }

    /**
     * Display a listing of the Perangkat.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {

        $this->perangkatRepository->pushCriteria(new RequestCriteria($request));
        $perangkats = $this->perangkatRepository->all();
        return view('perangkats.index')
            ->with('perangkats', $perangkats);
    }

    /**
     * Show the form for creating a new Perangkat.
     *
     * @return Response
     */
    public function create()
    {
        return view('perangkats.create');
    }

    /**
     * Store a newly created Perangkat in storage.
     *
     * @param CreatePerangkatRequest $request
     *
     * @return Response
     */
    public function store(CreatePerangkatRequest $request)
    {
        $input = $request->all();

        $perangkat = $this->perangkatRepository->create($input);

        Flash::success('Perangkat saved successfully.');

        return redirect(route('perangkats.index'));
    }

    /**
     * Display the specified Perangkat.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $perangkat = $this->perangkatRepository->findWithoutFail($id);

        if (empty($perangkat)) {
            Flash::error('Perangkat not found');

            return redirect(route('perangkats.index'));
        }

        return view('perangkats.show')->with('perangkat', $perangkat);
    }

    /**
     * Show the form for editing the specified Perangkat.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $perangkat = $this->perangkatRepository->findWithoutFail($id);

        if (empty($perangkat)) {
            Flash::error('Perangkat not found');

            return redirect(route('perangkats.index'));
        }

        return view('perangkats.edit')->with('perangkat', $perangkat);
    }

    /**
     * Update the specified Perangkat in storage.
     *
     * @param  int              $id
     * @param UpdatePerangkatRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatePerangkatRequest $request)
    {
        $perangkat = $this->perangkatRepository->findWithoutFail($id);



        if (empty($perangkat)) {
            Flash::error('Perangkat not found');

            return redirect(route('perangkats.index'));
        }

        $perangkat = $this->perangkatRepository->update($request->all(), $id);

        Flash::success('Perangkat updated successfully.');

        return redirect(route('perangkats.index'));
    }

    /**
     * Remove the specified Perangkat from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
      public function getModalDelete($id = null)
      {
          $error = '';
          $model = '';
          $confirm_route =  route('perangkats.delete',['id'=>$id]);
          return View('admin.layouts/modal_confirmation', compact('error','model', 'confirm_route'));

      }

       public function getDelete($id = null)
       {
           $sample = Perangkat::destroy($id);

           // Redirect to the group management page
           return redirect(route('perangkats.index'))->with('success', Lang::get('message.success.delete'));

       }


       public function downloadExcel($type)
       {
           return response()->download(base_path('resources/excel-templates/template-perangkat.xlsx'));
       }

       public function importPerangkat(Request $request)
       {
           $this->validate($request, [
               'import_file' => 'required|mimes:xls,xlsx'
           ]);

           if ($request->hasFile('import_file')) {
               $path = $request->file('import_file')->getRealPath();
               Excel::import(new PerangkatImport, request()->file('import_file'));

               return back()->with('success', 'Inserted Data Perangkat Successfully');

           }
           return back()->with('error', 'Please Check your file, Something is wrong there.');
       }

       public function exportPerangkat()
       {
           return Excel::download(new PerangkatExport, 'daftar-perangkat.xlsx');
       }
}
