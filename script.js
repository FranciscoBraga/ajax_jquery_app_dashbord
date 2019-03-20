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
})