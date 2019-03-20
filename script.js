$(document).ready(() => {
    
    $('#documentacao').on('click',()=>{
        //requisição com metodologia ajax

        //load
        //  $('#pagina').load('documentacao.html')

        //get
    /*  $.get('documentacao.html', response=>{
            $('#pagina').html(response)
        }) */

        //post
        $.post('documentacao.html', response=>{
            $('#pagina').html(response)
        })
    })

    $('#suporte').on('click', ()=>{
       
        // $('#pagina').load('suporte.html')

        //get
        /* $.get('suporte.html', response =>{
            $('#pagina').html(response)
        }) */

        //post
        $.post('suporte.html', response => {
            $('#pagina').html(response)
         })
    })
    //pegando o valor do select competencia
    $('#competencia').on('change', e =>{
       // console.log($(e.target).val())
       let competencia = $(e.target).val()

       $.ajax({
           type:'GET',
           url:'app.php',
           data:`competencia=${competencia}`,//x-www-form-urlenconded
           dataType:'json',
           success: dados => {
               $('#numero_vendas').html(dados.numero_vendas),
               $('#total_vendas').html(dados.total_vendas),
               console.log(dados)
           },
           error: error => {console.log(error)}
       })
    })
})