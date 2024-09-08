
document.addEventListener('DOMContentLoaded', function () {
    var containers = document.getElementsByClassName('section');

    $('.container .section').each((i, el) => {
        new Sortable(el, {
            animation: 150,
            group: {
                name: 'shared'
                // To clone: set pull to 'clone'
            },
            onEnd: function (evt) {
                var order = [];
                el.querySelectorAll('.box').forEach(function (box) {
                    order.push([box.getAttribute('data-name'), box.getAttribute('data-url')]);
                });
                console.log(order);
            }
        });
    })
});

// function report_gen() {
//     $(document).ready(function () {
//         var data = [];

//         // Populando o array data conforme o código anterior
//         $('.card-cava').each((i, el) => {
//             var title = el.querySelector('.title-cava').textContent;
//             var cava = {};
//             cava[title] = [];
//             $(el.querySelectorAll('.section .card')).each((i, el2) => {
//                 var name = el2.getAttribute('data-name');
//                 var url = el2.getAttribute('data-url');
//                 cava[title].push([name, url]);
//             });
//             data.push(cava);
//         });

//         // Convertendo o objeto JavaScript em uma string JSON
//         var jsonData = JSON.stringify(data);

//         // Adicionando a string JSON ao campo de entrada oculto
//         $('#dataInput').val(jsonData);
//     });




//     // data.forEach(obj => {
//     //     // Iterando sobre as chaves do objeto
//     //     for (let key in obj) {
//     //         console.log(`Chave: ${key}`);
//     //         console.log(`Valores: ${obj[key]}`);

//     //         // Iterando sobre os valores do array associado à chave
//     //         obj[key].forEach(value => {
//     //             console.log(`ID: ${value[0]}`);
//     //             console.log(`URL: ${value[1]}`);
//     //         });
//     //     }
//     // });

//     $.ajaxSetup({
//         headers: {
//             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
//         }
//     });


//     $.ajax({
//         url: '/generate-pdf',  // Substitua pela URL do seu controlador
//         type: 'POST',
//         data: JSON.stringify(data),
//         contentType: 'application/json',
//         success: function (response) {
//             console.log('Dados enviados com sucesso:', response);
//         },
//         error: function (xhr, status, error) {
//             console.error('Erro ao enviar os dados:', error);
//         }
//     });

// }


function gen_report() {
    $(document).ready(function () {
        var data = [];
        var qnt_cavas = [0, 0, 0]
        // Populando o array data conforme o código anterior
        $('.card-cava').each((i, el) => {
            var title = el.querySelector('.title-cava').textContent;


            if (title.toLowerCase().includes("explosivo")) {
                qnt_cavas[0] += 1
            } else if (title.toLowerCase().includes("sem")) {
                qnt_cavas[1] += 1
            } else if (title.toLowerCase().includes("especial")) {
                qnt_cavas[2] += 1
            }

            var bar = el.querySelector('input[name="bar"]').value;

            var title = el.querySelector('.title-cava').textContent;
            var cava = {};
            cava[title] = [];
            $(el.querySelectorAll('.section .card')).each((i, el2) => {

                if (i > 4) {
                    return;

                }

                var name = el2.getAttribute('data-name');
                var url = el2.getAttribute('data-url');
                cava[title].push([name, url, bar]);
            });
            data.push(cava);
        });




        // Convertendo o objeto JavaScript em uma string JSON

        var jsonData = JSON.stringify(data);




        console.log(jsonData)


        $('input[name="qnt_cavas"]').val(qnt_cavas);
        // Adicionando a string JSON ao campo de entrada oculto
        $('#dataInput').val(jsonData);

        $('.dataForm').submit()
    });
}