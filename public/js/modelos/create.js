$(function() {
    
    $('#select_marca').on('change', onSelectMarcaChange);
});

function onSelectMarcaChange(argument) {
    var marca_id = $(this).val();
    //alert(marca_id);//MUESTRA, EN UN ALERT, EL ID DEL DEPARTAMENTO SELECCIONADO
    //console.log(marca_id);MUESTRA EN CONSOLA EL ID DEL DEPARTAMENTO SELECCIONADO
    if (! marca_id)//SI marca_id ESTÁ VACIO
    {
        $('#select_modelo').html('<option value="">CLICK PARA SELECCIONAR MODELO</option>');
        return;
    }
    else//SI marca_id NO ESTÁ VACIO
    {
        $.get('/api/modelos/'+marca_id+'/obtener_modelos', function (modelos) {
        // var html_select = '';
        // for(var i=0; i<modelos.length; i++)
        // {
        //     console.log(modelos[i]);
        // }
        // if (modelos.length > 1) {
        //     console.log('hay');
        // } else {
        //     console.log('no hay');
        // }
        var html_select = '<option value="">CLICK PARA SELECCIONAR MODELO</option>';
        for (var i=0; i<modelos.length; i++)
            if (modelos[i].calibre)
            {
                html_select += '<option value="'+modelos[i].id+'">'+modelos[i].modelo+', '+modelos[i].calibre+'</option>';
            }
            else
            {
                html_select += '<option value="'+modelos[i].id+'">'+modelos[i].modelo+'</option>';
            }
        $('#select_modelo').html(html_select);
        });
    }
}