$(function() {
    
    $('#select_provincia').on('change', onSelectProvinciaChange);
});

function onSelectProvinciaChange(argument) {
    var provincia_id = $(this).val();
    //alert(provincia_id);//MUESTRA, EN UN ALERT, EL ID DEL DEPARTAMENTO SELECCIONADO
    //console.log(provincia_id);MUESTRA EN CONSOLA EL ID DEL DEPARTAMENTO SELECCIONADO
    if (! provincia_id)//SI provincia_id ESTÁ VACIO
    {
        $('#select_municipio').html('<option value="">CLICK PARA SELECCIONAR MUNICIPIO</option>');
        return;
    }
    else//SI provincia_id NO ESTÁ VACIO
    {
        $.get('/api/municipios/'+provincia_id+'/obtener_municipios', function (municipios) {
        // var html_select = '';
        // for(var i=0; i<provincias.length; i++)
        // {
        //     console.log(provincias[i]);
        // }
        // if (provincias.length > 1) {
        //     console.log('hay');
        // } else {
        //     console.log('no hay');
        // }
        var html_select = '<option value="">CLICK PARA SELECCIONAR MUNICIPIO</option>';
        for (var i=0; i<municipios.length; i++)
            html_select += '<option value="'+municipios[i].id+'">'+municipios[i].municipio+'</option>';
        $('#select_municipio').html(html_select);
        });
    }
}