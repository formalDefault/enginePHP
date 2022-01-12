$(document).ready(function() {
  
  $("fieldset").children().each( function(i) {
    // $(this).addClass("a" + i.toString());

    // Campos generales
    if(i <= 10) {
      $(this).addClass("generales");
    
    } else if (i == 11) {
      $(this).addClass("computo");

    } else if (i == 12) {
      $(this).addClass("mobiliario");

    } else if (i == 13) {
      $(this).addClass("telefonico");

    } else if (i >= 14 && i <= 19) {
      $(this).addClass("vehiculo");

    } else if (i == 20) {
      $(this).addClass("medico");

    } else {
      $(this).addClass("botones");
    }

  });


  // Formulario dinamico
  $("#tipo").change(function() {
    var tipo = $("#tipo").val();
    
    
    if (tipo == 'Computo') {
      
      // Computo
      $(".computo").css("display", "unset");
      // Mobiliario
      $(".mobiliario").css("display", "none");
      // Telefonico
      $(".telefonico").css("display", "none");
      // Vehiculo
      $(".vehiculo").css("display", "none");
      // Medico
      $(".medico").css("display", "none");

      // Campos deshabilitados
      $("#vehiculo-placas").attr('disabled', true);
      $("#vehiculo-marca").attr('disabled', true);
      $("#vehiculo-modelo").attr('disabled', true);
      $("#vehiculo-anio").attr('disabled', true);
      $("#vehiculo-motor").attr('disabled', true);
      $("#vehiculo-color").attr('disabled', true);
      
    } else if (tipo == 'Mobiliario') {
      
      // Computo
      $(".computo").css("display", "none");
      // Mobiliario
      $(".mobiliario").css("display", "unset");
      // Telefonico
      $(".telefonico").css("display", "none");
      // Vehiculo
      $(".vehiculo").css("display", "none");
      // Medico
      $(".medico").css("display", "none");

      // Campos deshabilitados
      $("#vehiculo-placas").attr('disabled', true);
      $("#vehiculo-marca").attr('disabled', true);
      $("#vehiculo-modelo").attr('disabled', true);
      $("#vehiculo-anio").attr('disabled', true);
      $("#vehiculo-motor").attr('disabled', true);
      $("#vehiculo-color").attr('disabled', true);

    } else if (tipo == 'Telefonico') {
      
      // Computo
      $(".computo").css("display", "none");
      // Mobiliario
      $(".mobiliario").css("display", "none");
      // Telefonico
      $(".telefonico").css("display", "unset");
      // Vehiculo
      $(".vehiculo").css("display", "none");
      // Medico
      $(".medico").css("display", "none");

      // Campos deshabilitados
      $("#vehiculo-placas").attr('disabled', true);
      $("#vehiculo-marca").attr('disabled', true);
      $("#vehiculo-modelo").attr('disabled', true);
      $("#vehiculo-anio").attr('disabled', true);
      $("#vehiculo-motor").attr('disabled', true);
      $("#vehiculo-color").attr('disabled', true);

    } else if (tipo == 'Vehiculo') {

      // Computo
      $(".computo").css("display", "none");
      // Mobiliario
      $(".mobiliario").css("display", "none");
      // Telefonico
      $(".telefonico").css("display", "none");
      // Vehiculo
      $(".vehiculo").css("display", "unset");
      // Medico
      $(".medico").css("display", "none");

      // Campos deshabilitados
      $("#vehiculo-placas").attr('disabled', false);
      $("#vehiculo-marca").attr('disabled', false);
      $("#vehiculo-modelo").attr('disabled', false);
      $("#vehiculo-anio").attr('disabled', false);
      $("#vehiculo-motor").attr('disabled', false);
      $("#vehiculo-color").attr('disabled', false);

    } else if (tipo == 'Medico') {
      
      // Computo
      $(".computo").css("display", "none");
      // Mobiliario
      $(".mobiliario").css("display", "none");
      // Telefonico
      $(".telefonico").css("display", "none");
      // Vehiculo
      $(".vehiculo").css("display", "none");
      // Medico
      $(".medico").css("display", "unset");

      // Campos deshabilitados
      $("#vehiculo-placas").attr('disabled', true);
      $("#vehiculo-marca").attr('disabled', true);
      $("#vehiculo-modelo").attr('disabled', true);
      $("#vehiculo-anio").attr('disabled', true);
      $("#vehiculo-motor").attr('disabled', true);
      $("#vehiculo-color").attr('disabled', true);

    } else {

      // Computo
      $(".computo").css("display", "none");
      // Mobiliario
      $(".mobiliario").css("display", "none");
      // Telefonico
      $(".telefonico").css("display", "none");
      // Vehiculo
      $(".vehiculo").css("display", "none");
      // Medico
      $(".medico").css("display", "none");

      // Campos deshabilitados
      $("#vehiculo-placas").attr('disabled', true);
      $("#vehiculo-marca").attr('disabled', true);
      $("#vehiculo-modelo").attr('disabled', true);
      $("#vehiculo-anio").attr('disabled', true);
      $("#vehiculo-motor").attr('disabled', true);
      $("#vehiculo-color").attr('disabled', true);

    }

  });

});
