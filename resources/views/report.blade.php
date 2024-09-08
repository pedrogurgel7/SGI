<script>

    function send(){
        $(document).ready(function() {
        var data = [];

        // Populando o array data conforme o código anterior
        $('.card-cava').each((i, el) => {
            var title = el.querySelector('.title-cava').textContent;
            var cava = {};
            cava[title] = [];
            $(el.querySelectorAll('.section .card')).each((i, el2) => {
                var name = el2.getAttribute('data-name');
                var url = el2.getAttribute('data-url');
                cava[title].push([name, url]);
            });
            data.push(cava);
        });

        // Convertendo o objeto JavaScript em uma string JSON
        var jsonData = JSON.stringify(data);

        // Adicionando a string JSON ao campo de entrada oculto
        $('#dataInput').val(jsonData);
    });
    }
    
</script>

<x-app-layout>

    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Sortable/1.14.0/Sortable.min.js"></script>
    <script src="{{ asset('js/main.js') }}"></script>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    @csrf


    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">


                    <button class="mb-10 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded btn" onclick="gen_report()" >
                        Gerar relatório
                    </button>

                    <form target="_blank" class="dataForm bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4" id="dataForm" action="/generate-pdf" method="POST">
                        @csrf <!-- Adiciona o token CSRF -->
                        


                        <label class="block text-gray-700 text-sm font-bold mb-2" for="num_projeto">
                            NUM PROJETO
                        </label>

                        <input class="mb-2 shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" name="projeto"  id="num_projeto" value={{$a}} type="text" placeholder="NUM PROJETO" >
                     
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="titulo_obra">
                            TITULO DA OBRA
                        </label>
                        <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"  name="obra" id="titulo_obra" type="text" value="EXTENSÃO DE REDE" placeholder="TITULO DA OBRA">
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="titulo_municipio">
                             MUNICÍPIO
                        </label>
                        <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"  name="municipio" id="titulo_municipio" type="text" placeholder="TITULO DA MUNICÍPIO">
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2"  for="data">
                            DATA
                        </label>
                    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" name="data_obra" id="data" type="text"  placeholder="DATA">
                    </div>

                    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" name="qnt_cavas" id="qnt_cavas" type="hidden"  placeholder="DATA">
                    
                
                </div>





                     <input type="hidden" name="data" id="dataInput">
                         
                    </form>


                    <div class="container p-2">



                        @foreach ($folders as $key=> $folder )

                        <div class="card-cava">


                            <span class="title-cava">{{$key}}</span>
                            
                            
                               
                            <input placeholder="Barramento"  type="text" id="small-input" name="bar" class="mt-2 mb-2 block w-50 p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-xs focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            


                            <div class="section">

                                
                                @foreach ($folder as $key=>$f)
                                <div class="box card" data-name="{{$f[0]}}" data-url="{{$f[1]}}"><img class="card-img-top" src="{{$f[1]}}" alt="Image 1">
                                </div>
                                @endforeach



                            </div>

                        </div>
                        @endforeach



                    </div>


                </div>
            </div>
        </div>
    </div>
</x-app-layout>

