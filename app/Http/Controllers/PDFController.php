<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Barryvdh\DomPDF\Facade\Pdf;

$out = new \Symfony\Component\Console\Output\ConsoleOutput();

class PDFController extends Controller
{
    public function generatePDF(Request $request)
    {
        // Receber os dados enviados via AJAX
        $data = $request->input();

        $qnt_cavas = explode(',', $data['qnt_cavas']);
        $qnt_explosivo = $qnt_cavas[0];
        $qnt_rocha = $qnt_cavas[1];
        $qnt_embasamento = $qnt_cavas[2];


        $projeto = $data["projeto"];



        $obra = $data["obra"];
        $municipio = $data["municipio"];
        $data_obra = $data["data_obra"];


        $data  =  json_decode($data["data"], true);


        //dd($data);
        // foreach ($data as $key => $value) {
        //     echo $key;
        // }

        // return 'end';

        //return view('pdf.pdf_template', ['data' => $data]);


        $pdf = Pdf::loadView('pdf.pdf_template', [
            'projeto' => $projeto,
            'obra' => $obra,
            'municipio' => $municipio,
            'data_obra' => $data_obra,
            'qnt_explosivo' => $qnt_explosivo,
            'qnt_rocha' => $qnt_rocha,
            'qnt_embasamento' => $qnt_embasamento,
            'data' => $data,

        ])->setPaper('a4')
            ->setOption('margin-top', '0cm')
            ->setOption('margin-bottom', '0cm');

        return $pdf->download('010P' . $projeto . 'S001.pdf');




        // Processar os dados conforme necessário
        // $formattedData = [];
        // foreach ($data as $item) {
        //     foreach ($item as $key => $values) {
        //         $formattedData[] = [
        //             'title' => $key,
        //             'values' => $values,
        //         ];
        //     }
        // }

        // Gerar o PDF usando uma view
        // $pdf = PDF::loadView('pdf_view', compact('formattedData'));

        // Retornar o PDF para download
        //return $pdf->download('documento.pdf');
    }
}
