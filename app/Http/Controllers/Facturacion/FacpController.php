<?php namespace App\Http\Controllers\Facturacion;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\EditUserRequest;
use App\sw_empleado;
use App\sw_registro_lavado;
use App\sw_usuario;
use App\sw_ctl_lavado;
use App\sw_det_lavado;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;


use App\User;
use Illuminate\Http\Request;

use Illuminate\Routing\Redirector;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Auth\Registrar;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use DateTime;
use Maatwebsite\Excel\Facades\Excel;
use DateInterval;
use Carbon\Carbon;
use Faker\Factory as Faker;

class FacpController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $id =Auth::user()->usr_id;
        $menus = \DB::select('
                            select * from
                            fn_get_modules(?)',array($id));

        $proveedores = \DB::select('select * from sw_proveedor
        ');
        return view('facturacion.pruebas.index',compact('menus','proveedores'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //dd($id);
        Excel::create('Mi primer archivo excel desde Laravel', function($excel)
        {
            $excel->sheet('Sheetname', function($sheet)
            {
                $sheet->mergeCells('A1:C1');

                $sheet->setBorder('A1:F1', 'thin');

                $sheet->cells('A1:F1', function($cells)
                {
                    $cells->setBackground('#000000');
                    $cells->setFontColor('#FFFFFF');
                    $cells->setAlignment('center');
                    $cells->setValignment('center');
                });

                $sheet->setWidth(array
                    (
                        'D' => '50'
                    )
                );

                $sheet->setHeight(array
                    (
                        '1' => '50'
                    )
                );

                $data=[];

                array_push($data, array('Kevin', '', '', 'Arnold', 'Arias', 'Figueroa'));

                $sheet->fromArray($data, null, 'A1', false, false);
            });
        })->download('xlsx');

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }

}
