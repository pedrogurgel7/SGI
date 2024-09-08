<?php

namespace App\Http\Controllers;

use Kreait\Firebase\Factory;
use Illuminate\Http\Request;
use Google\ApiCore\RequestBuilder;
use \DataTime;
use League\CommonMark\Extension\CommonMark\Node\Block\ListItem;

use function Termwind\render;

class ZdezController extends Controller

{

    function index(Request $request)
    {


        if ($request->input('search-download')) {
            return redirect()->route('download_dashboard', ['a' => $request->input('search-download')]);
        }


        if ($request->input('search-report')) {
            return redirect()->route('report_dashboard', ['a' => $request->input('search-report')]);
        }


        return view('dashboard');
    }
    public function show(String $a)
    {
        $factory = (new Factory)->withServiceAccount('../firebase_credentail.json')->withDatabaseUri('came-3e4e6.appspot.com')->createStorage();

        $objects =  $factory->getBucket()->objects([
            'prefix' => $a,

        ]);


        $names = [];
        foreach ($objects as $object) {
            $name  = $object->name();
            $names[] = $name;
        }

        $folders = [];
        foreach ($names as $name) {
            $cava_name = explode('/', $name)[1];
            $photo_id = explode('.', explode('/', $name)[2])[0];

            $url = $factory->getBucket()->object($name)->signedUrl(new \DateTime('+1 hour'));
            if (key_exists($cava_name, $folders)) {

                array_push($folders[$cava_name], [$photo_id, $url]);
            } else {
                $folders[$cava_name] = [[$photo_id, $url]];
            };
        };


        return view('report',  ['a' => $a,  'folders' => $folders]);
    }


    public function download(String $a)
    {
        $factory = (new Factory)->withServiceAccount('../firebase_credentail.json')->withDatabaseUri('came-3e4e6.appspot.com')->createStorage();
        // $st = $factory->createStorage()->getBucket();
        // dd($st);

        //$objets =  $factory->getBucket()->objects(['prefix'=>['A']]);



        $objets =  $factory->getBucket()->objects([
            'prefix' => $a,
        ]);





        // if(empty(iterator_to_array($objets))){
        //     return view('nocavas');
        // }

        $zipFilePath = __DIR__ . '/temp.zip';
        // Criar um objeto ZipArchive
        $zip = new \ZipArchive();

        if ($zip->open($zipFilePath, \ZipArchive::CREATE | \ZipArchive::OVERWRITE) === TRUE) {
            // Listar os arquivos e diretórios no caminho do Firebase Storage
            $files = $factory->getBucket()->objects([
                'prefix' => $a,
            ]);

            foreach ($files as $file) {
                $filePath = $file->name();
                // Obter o conteúdo do arquivo do Firebase Storage
                $fileContent = $factory->getBucket()->object($filePath)->downloadAsString();
                // Adicionar o conteúdo do arquivo ao zip
                $zip->addFromString(substr($filePath, strlen($a)), $fileContent);
            }
            // Fechar o arquivo zip
            $zip->close();

            // Define os cabeçalhos HTTP para forçar o download do arquivo zip
            header('Content-Type: application/zip');
            header('Content-Disposition: attachment; filename="' . $a . '.zip" ');
            header('Content-Length: ' . filesize($zipFilePath));

            // Envie o arquivo zip para o navegador
            readfile($zipFilePath);

            // Exclua o arquivo zip temporário
            unlink($zipFilePath);
        } else {
            echo 'Não foi possível criar o arquivo zip';
        }

        // foreach($objets as $obj) {
        //         print( $factory->getBucket()->object($obj->name())->signedUrl(New \DateTime('+1 hour') ).'<br>');
        // }


    }
}
