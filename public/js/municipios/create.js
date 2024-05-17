$(function() {
    
    $('#select_departamento').on('change', onSelectDepartamentoChange);
});

function onSelectDepartamentoChange(argument) {
    var departamento_id = $(this).val();
    //alert(departamento_id);//MUESTRA, EN UN ALERT, EL ID DEL DEPARTAMENTO SELECCIONADO
    //console.log(departamento_id);MUESTRA EN CONSOLA EL ID DEL DEPARTAMENTO SELECCIONADO
    if (! departamento_id)//SI departamento_id ESTÁ VACIO
    {
        $('#select_provincia').html('<option value="">CLICK PARA SELECCIONAR PROVINCIA</option>');
        return;
    }
    else//SI departamento_id NO ESTÁ VACIO
    {
        $.get('/api/provincias/'+departamento_id+'/obtener_provincias', function (provincias) {
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
        var html_select = '<option value="">CLICK PARA SELECCIONAR PROVINCIA</option>';
        for (var i=0; i<provincias.length; i++)
            html_select += '<option value="'+provincias[i].id+'">'+provincias[i].provincia+'</option>';
        $('#select_provincia').html(html_select);
        });
    }
}