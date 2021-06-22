<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Requests\CreatePeminjamanRequest;
use App\Http\Requests\UpdatePeminjamanRequest;
use App\Repositories\PeminjamanRepository;
use App\Http\Controllers\AppBaseController as InfyOmBaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;
use App\Models\Peminjaman;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class PeminjamanController extends InfyOmBaseController
{
    /** @var  PeminjamanRepository */
    private $peminjamanRepository;

    public function __construct(PeminjamanRepository $peminjamanRepo)
    {
        $this->peminjamanRepository = $peminjamanRepo;
    }

    /**
     * Display a listing of the Peminjaman.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {

        $this->peminjamanRepository->pushCriteria(new RequestCriteria($request));
        $peminjaman = $this->peminjamanRepository->all();
        return view('peminjaman.index')
            ->with('peminjaman', $peminjaman);
    }

    /**
     * Show the form for creating a new Peminjaman.
     *
     * @return Response
     */
    public function create()
    {
        return view('peminjaman.create');
    }

    /**
     * Store a newly created Peminjaman in storage.
     *
     * @param CreatePeminjamanRequest $request
     *
     * @return Response
     */
    public function store(CreatePeminjamanRequest $request)
    {
        $input = $request->all();

        $peminjaman = $this->peminjamanRepository->create($input);

        Flash::success('Peminjaman saved successfully.');

        return redirect(route('peminjaman.index'));
    }

    /**
     * Display the specified Peminjaman.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $peminjaman = $this->peminjamanRepository->findWithoutFail($id);

        if (empty($peminjaman)) {
            Flash::error('Peminjaman not found');

            return redirect(route('peminjaman.index'));
        }

        return view('peminjaman.show')->with('peminjaman', $peminjaman);
    }

    /**
     * Show the form for editing the specified Peminjaman.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $peminjaman = $this->peminjamanRepository->findWithoutFail($id);

        if (empty($peminjaman)) {
            Flash::error('Peminjaman not found');

            return redirect(route('peminjaman.index'));
        }

        return view('peminjaman.edit')->with('peminjaman', $peminjaman);
    }

    /**
     * Update the specified Peminjaman in storage.
     *
     * @param  int              $id
     * @param UpdatePeminjamanRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatePeminjamanRequest $request)
    {
        $peminjaman = $this->peminjamanRepository->findWithoutFail($id);

        

        if (empty($peminjaman)) {
            Flash::error('Peminjaman not found');

            return redirect(route('peminjaman.index'));
        }

        $peminjaman = $this->peminjamanRepository->update($request->all(), $id);

        Flash::success('Peminjaman updated successfully.');

        return redirect(route('peminjaman.index'));
    }

    /**
     * Remove the specified Peminjaman from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
      public function getModalDelete($id = null)
      {
          $error = '';
          $model = '';
          $confirm_route =  route('peminjaman.delete',['id'=>$id]);
          return View('admin.layouts/modal_confirmation', compact('error','model', 'confirm_route'));

      }

       public function getDelete($id = null)
       {
           $sample = Peminjaman::destroy($id);

           // Redirect to the group management page
           return redirect(route('peminjaman.index'))->with('success', Lang::get('message.success.delete'));

       }

}
