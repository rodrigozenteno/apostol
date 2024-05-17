$(function() {
    
    $('#select_industria').on('change', onSelectIndustriaChange);
});

function onSelectIndustriaChange(argument) {
    var industria_id = $(this).val();
    //alert(industria_id);//MUESTRA, EN UN ALERT, EL ID DEL DEPARTAMENTO SELECCIONADO
    //console.log(industria_id);MUESTRA EN CONSOLA EL ID DEL DEPARTAMENTO SELECCIONADO
    if (! industria_id)//SI industria_id ESTÁ VACIO
    {
        $('#select_marcas').html('<option value="">CLICK PARA SELECCIONAR MARCA</option>');
        return;
    }
    else//SI industria_id NO ESTÁ VACIO
    {
        $.get('/api/marcas/'+industria_id+'/obtener_marcas', function (marcas) {
        // var html_select = '';
        // for(var i=0; i<marcas.length; i++)
        // {
        //     console.log(marcas[i]);
        // }
        // if (marcas.length > 1) {
        //     console.log('hay');
        // } else {
        //     console.log('no hay');
        // }
        var html_select = '<option value="">CLICK PARA SELECCIONAR MARCA</option>';
        for (var i=0; i<marcas.length; i++)
            html_select += '<option value="'+marcas[i].id+'">'+marcas[i].marca+'</option>';
        $('#select_marca').html(html_select);
        });
    }
}