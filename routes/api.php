<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Postalcode;


Route::get('/zip-codes/{zipcode}', function (Request $request) {
    // if we don't get at list one, we fail
    $rawinfo=Postalcode::where('d_codigo',$request->zipcode)->firstOrFail();

    if($rawinfo){
        //we build all settlements objects into a collection
        $settlements=Postalcode::where('d_codigo',$request->zipcode)->get(
            [
                'id_asenta_cpcons', 'd_asenta','d_zona','d_tipo_asenta'
            ]
        );

        $settlements=$settlements->map(function($item){
            $comp=new stdClass();

            $comp->key = (int)$item->id_asenta_cpcons;
            $comp->name =strtoupper($item->d_asenta);
            $comp->zone_type= strtoupper($item->d_zona);
            $comp->settlement_type=new stdClass();
            $comp->settlement_type->name=$item->d_tipo_asenta;
            return  $comp;
        });

        //we build all zip info including the settlements
        $zipinfo=new stdClass();
        $zipinfo->zip_code=$rawinfo->d_codigo;
        $zipinfo->locality=strtoupper($rawinfo->d_ciudad);
        $zipinfo->federal_entity=new stdClass();
        $zipinfo->federal_entity->key=(int)$rawinfo->c_estado;
        $zipinfo->federal_entity->name=strtoupper($rawinfo->d_estado);
        $zipinfo->federal_entity->code=$rawinfo->c_CP == '' ? null : $rawinfo->c_CP;
        $zipinfo->settlements=new stdClass();
        $zipinfo->settlements=$settlements;
        $zipinfo->municipality=new stdClass();
        $zipinfo->municipality->key=(int)$rawinfo->c_mnpio;
        $zipinfo->municipality->name=strtoupper($rawinfo->D_mnpio);

        return $zipinfo;
    }

});
