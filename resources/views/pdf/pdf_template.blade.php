<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{public_path('css/normalize.css')}}">
    <title>Relatório Fotográfico - Serviços de Solo</title>
    <style>
        @page {
            margin: 0cm 0.7cm 0cm 0cm;
        }
        body {
            font-family: Arial, sans-serif;
        }
        .container {
            width: 100%;
            max-width: 800px;
            margin: 0 auto;
            border: 1px solid #000;
            padding: 10px;
        }
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .services .header img {
            height: 50px;
        }
        .header div {
            flex-grow: 1;
            text-align: center;
            font-weight: bold;
        }
        .table-container {
            margin-top: 20px;
            border: 1px solid #000;
            margin-bottom: 10px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        .photos-section table {
            table-layout: fixed;
        }
        table,
        th,
        td {
            border: 1px solid #000;
        }
        th,
        td {
            padding: 5px;
            text-align: center;
        }
        .photos-section {
            margin-top: 20px;
        }
        .photos-section div {
            height: 200px;
            display: flex;
            justify-content: center;
            align-items: center;
            margin-bottom: 10px;
            background-color: #ffffff;
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
        }
        .registro-section {
            margin-bottom: 10px;
            display: flex;
            justify-content: space-between;
        }
        .registro-section div {
            width: 48%;
            border: 1px solid #000;
            height: 100px;
            display: flex;
            justify-content: center;
            align-items: center;
            margin-top: 10px;
            object-fit: contain;
        }
        .photo-container {
            width: 100%;
            height: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .photo-container img {
            max-width: 100%;
            max-height: 100%;
            object-fit: contain;
        }
        .green {
            background-color: green;
            color: white;
        }

        
        .signature-table {
            width: 100%;
            max-width: 500px;
            margin: 20px auto;
            border: 1px solid #000;
            border-collapse: collapse;
        }

        .signature-table th,
        .signature-table td {
            border: 1px solid #000;
            padding: 10px;
            text-align: center;
        }

        .signature-table th {
            background-color: #ffffff;
            font-weight: normal;
        }

        .signature-space {
            height: 100px;
        }
    </style>
</head>

<body>
    <div class="container a">
        <div class="header">
            <img src="{{public_path('images/logo.png')}}" alt="Neoenergia">
            <div>RELATÓRIO FOTOGRÁFICO<br>SERVIÇOS DE SOLO</div>
        </div>
        <div class="table-container">
            <table style="margin-bottom: 20px;">
                <tr>'projeto' => $projeto, 'obra' => $obra, 'municipio' => $municipio, 'data_obra' => $data_obra
                    <td colspan="1" class="green">NUM PROJETO</td>
                    <td colspan="5">{{$projeto}}</td>
                    <td colspan="2" class="green"></td>
                </tr>
                <tr>
                    <td colspan="1" class="green">TITULO DA OBRA</td>
                    <td colspan="8">{{$obra}}</td>
                </tr>
                <tr>
                    <td colspan="1" class="green">TITULO DA MUNICÍPIO</td>
                    <td colspan="5">{{$municipio}}</td>
                    <td colspan="1" class="green">EPS</td>
                    <td colspan="1"> VENCER</td>
                </tr>
                <tr>
                    <td colspan="1" class="green">DATA</td>
                    <td colspan="5">{{$data_obra}}</td>
                    <td colspan="1" class="green">FISCAL</td>
                    <td colspan="1"></td>
                </tr>
            </table>
            <table>
                <thead>
                    <tr class="green">
                        <th>SERVIÇO</th>
                        <th>DESCRIÇÃO</th>
                        <th>QT</th>
                        <th>VALOR UN</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>SDEMU300711</td>
                        <td>CAVA EM ROCHA</td>
                        <td>{{$qnt_rocha}}</td>
                        <td>627,99</td>
                    </tr>
                    <tr>
                        <td>SDEMU300811</td>
                        <td>CAVA EM ROCHA COM EXPLOSIVO</td>
                        <td>{{$qnt_explosivo}}</td>
                        <td>1.200,61 </td>
                    </tr>
                    <tr>
                        <td>SDEMU300811</td>
                        <td>CAVA EM ROCHA COM ROMPEDOR</td>
                        <td>0</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>SDEMU300111</td>
                        <td>FUNDAÇÃO ESPECIAL POSTE</td>
                        <td>{{$qnt_embasamento}}</td>
                        <td>1.169,16</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="photos-section">





            @foreach ($data as $key => $value)  
                
    
                @php
                      $cava_set = array_values($value)[0];
                @endphp
                @if($key != 0)
                    <div style="page-break-before: always;"> </div>
                @endif
                <table>
                    <tr>
                        <th>Barramento: {{$cava_set[0][2]}}</th>

                        @php
                            $cava_title = '';

                            if(str_contains(strtolower(key($value)), 'sem explosivo')){
                                $cava_title = 'CAVA EM ROCHA';
                            } 
                            elseif(str_contains(strtolower(key($value)), 'explosivo')){
                                $cava_title = 'CAVA EM ROCHA COM EXPLOSIVO';
                            }
                            elseif(str_contains(strtolower(key($value)), 'embasamento')){
                                $cava_title = 'FUNDACAO ESPECIAL POSTE';
                            }

                        @endphp
                        <th colspan="2">Serviço: {{$cava_title}} </th>
                    </tr>


                <tr>
                        <td>ANTES</td>
                        <td>DURANTE</td>
                        <td>DEPOIS</td>
                </tr>
                
                @foreach ($cava_set as $key => $value)  
                    @php
                        $cava_name = $value[0];
                        $cava_url = $value[1];
                        $cava_bar = $value[2]
                    @endphp
                       
                    @if ($key <3)

                        @if ($key ==0)
                        <tr>
                        @endif
                            
                            <td>
                                <div class="photo-container">
                                    <img src="data:image/png;base64,{{ base64_encode(file_get_contents($cava_url)) }}" alt="Antes">
                                </div>
                            </td>    
                        @if ($key ==2)
                        </tr> 
                        @endif 
                    @php
                    continue;
                    @endphp 
                    
                    @endif
               
                @if($key == 3)

                <tr>
                    <td>TRENA 1</td>
                    <td>TRENA 2</td>
                    <td>COMPLEMENTO</td>
                </tr>
                @endif


                @if($key > 2 & $key < 5)

                    @if ($key==3)
                     <tr>
                    @endif
                        
                            <td>
                                <div class="photo-container">
                                    <img src="data:image/png;base64,{{ base64_encode(file_get_contents($cava_url)) }}" alt="Antes">
                                </div>
                            </td>

                    @if ($key == 4)
                        <td>
                            <div class="photo-container">
                                <img alt="COMPLEMENTO">
                            </div>
                        </td>
                      </tr>
                    @endif
                            
                      
                        
                        @php
                        continue;
                        @endphp
                @else
                      @php
                      continue;
                      @endphp
                @endif


                 

                 @endforeach
                </table>
                 
                 
               
                
             @endforeach

    

             <div style="page-break-after: always;"> </div>
             <table class="signature-table">
                <tr>
                    <th>ASSINATURA DO AR
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    </th>
                    <th>ASSINATURA DO GESTOR DO CONTRATO</th>
                </tr>
                <tr>
                    <td colspan="1" class="signature-space"></td>
                    <td colspan="1" class="signature-space"></td>
                </tr>
            </table>
 
           
        </div>
    </div>
</body>
</html>
