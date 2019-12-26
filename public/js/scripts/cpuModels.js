$(document).on('change', 'select[name="type_model"]', function() {
  console.log('Esta escuchando!');
  var type_model = $(this).val();
  var select = $('select[name="cpu_model_id"]');
  select.empty();

  if (type_model) {
    console.log('Tipo de modelo =>', type_model);

    $.ajax({
      url:      '/admin/getCpuModels',
      data:     { "type_model": type_model },
      dataType: 'json',
      success:  function(data) {
        console.log(data);
        select.append($('<option>', {
          value: 0,
          text: "Seleccionar un Modelo de Cpu"
        }));
        
        $.each(data.modelosDeCpus, function(index, value) {
          select.append('<option value="'+ index +'">'+ value +'</option>');
        });
      },
/*       error: function (data) {
        console.log('Se presentan errores');
      } */
      error: function (jqXHR, textStatus, errorThrown) {
        console.log(jqXHR.responseText);
      }
    });
  } else {
    select.empty();
  };
});