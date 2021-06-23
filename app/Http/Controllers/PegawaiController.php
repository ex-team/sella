<?php

namespace App\Http\Controllers;

use App\Exports\PegawaiExport;
use App\Http\Requests;
use App\Http\Requests\CreatePegawaiRequest;
use App\Http\Requests\UpdatePegawaiRequest;
use App\Repositories\PegawaiRepository;
use App\Http\Controllers\AppBaseController as InfyOmBaseController;
use App\Imports\PegawaiImport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;
use App\Models\Pegawai;
use Flash;
use Illuminate\Support\Facades\File;
use Maatwebsite\Excel\Facades\Excel;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class PegawaiController extends InfyOmBaseController
{
    /** @var  PegawaiRepository */
    private $pegawaiRepository;

    public function __construct(PegawaiRepository $pegawaiRepo)
    {
        $this->pegawaiRepository = $pegawaiRepo;
    }

    /**
     * Display a listing of the Pegawai.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {

        $this->pegawaiRepository->pushCriteria(new RequestCriteria($request));
        $pegawais = $this->pegawaiRepository->all();
        return view('pegawais.index')->with('pegawais', $pegawais);
    }

    /**
     * Show the form for creating a new Pegawai.
     *
     * @return Response
     */
    public function create()
    {
        return view('pegawais.create');
    }

    /**
     * Store a newly created Pegawai in storage.
     *
     * @param CreatePegawaiRequest $request
     *
     * @return Response
     */
    public function store(CreatePegawaiRequest $request)
    {

        $pegawai = $this->pegawaiRepository->create($request->all());

       //upload image
       if ($file = $request->file('foto')) {
            $extension = $file->extension()?: 'png';
            $destinationPath = public_path() . '/uploads/';
            $safeName = str_random(10) . '.' . $extension;
            $file->move($destinationPath, $safeName);
            $request['foto'] = $safeName;
            $pegawai->foto = $safeName;
        }

        $pegawai->save();

        Flash::success('Pegawai saved successfully.');

        return redirect(route('pegawais.index'));
    }

    /**
     * Display the specified Pegawai.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $pegawai = $this->pegawaiRepository->findWithoutFail($id);

        if (empty($pegawai)) {
            Flash::error('Pegawai not found');

            return redirect(route('pegawais.index'));
        }

        return view('pegawais.show')->with('pegawai', $pegawai);
    }

    /**
     * Show the form for editing the specified Pegawai.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $pegawai = $this->pegawaiRepository->findWithoutFail($id);

        if (empty($pegawai)) {
            Flash::error('Pegawai not found');

            return redirect(route('pegawais.index'));
        }

        return view('pegawais.edit')->with('pegawai', $pegawai);
    }

    /**
     * Update the specified Pegawai in storage.
     *
     * @param  int              $id
     * @param UpdatePegawaiRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatePegawaiRequest $request)
    {
        $pegawai = $this->pegawaiRepository->findWithoutFail($id);


        if (empty($pegawai)) {
            Flash::error('Pegawai not found');

            return redirect(route('pegawais.index'));
        }


        $pegawai->update($request->except('foto'));

        // is new image uploaded?
        if ($file = $request->file('foto')) {
            $extension = $file->extension()?: 'png';
            $destinationPath = public_path() . '/uploads/';
            $safeName = str_random(10) . '.' . $extension;
            $file->move($destinationPath, $safeName);
            //delete old pic if exists
            if (File::exists($destinationPath . $pegawai->foto)) {
                File::delete($destinationPath . $pegawai->foto);
            }
            //save new file path into db
            $pegawai->foto = $safeName;
        }

        //save record
        $pegawai->save();

        Flash::success('Pegawai updated successfully.');

        return redirect(route('pegawais.index'));
    }

    /**
     * Remove the specified Pegawai from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
      public function getModalDelete($id = null)
      {
          $error = '';
          $model = '';
          $confirm_route =  route('pegawais.delete',['id'=>$id]);
          return View('admin.layouts/modal_confirmation', compact('error','model', 'confirm_route'));

      }

       public function getDelete($id = null)
       {
           $sample = Pegawai::destroy($id);

           // Redirect to the group management page
           return redirect(route('pegawais.index'))->with('success', Lang::get('message.success.delete'));

       }

       public function downloadExcel($type)
       {
           return response()->download(base_path('resources/excel-templates/template-pegawai.xlsx'));
       }

       public function importPegawai(Request $request)
       {
           $this->validate($request, [
               'import_file' => 'required|mimes:xls,xlsx'
           ]);

           if ($request->hasFile('import_file')) {
               $path = $request->file('import_file')->getRealPath();
               Excel::import(new PegawaiImport, request()->file('import_file'));

               return back()->with('success', 'Inserted Data Pegawai Successfully');

           }
           return back()->with('error', 'Please Check your file, Something is wrong there.');
       }

       public function exportPegawai()
       {
           return Excel::download(new PegawaiExport, 'daftar-pegawai.xlsx');
       }

}
