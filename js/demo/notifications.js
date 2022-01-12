$(function () {
	
	
	/*--------------------------------------------------
	Plugin: Lightbox
	--------------------------------------------------*/	
	
	$('.lightbox-type').lightbox ();
	
	/*--------------------------------------------------
	Plugin: Msg Growl
	--------------------------------------------------*/	
	$('.growl-type').live ('click', function (e) {
		$.msgGrowl ({
			type: $(this).attr ('data-type')
			, title: 'Header'
			, text: 'Lorem ipsum dolor sit amet, consectetur ipsum dolor sit amet, consectetur.'
		});
	});
	
	
	
	/*--------------------------------------------------
	Plugin: Msg Box
	--------------------------------------------------*/
	
	$('.msgbox-alert').live ('click', function (e) {
		var $mensaje = $(this).attr("alt");
		var $url = $(this).attr("url");
		$.msgbox($mensaje);
		function elimina(){
			window.location=$url;
		}

	});
	$('.msgbox-alerta').live ('click', function (e) {

		var $mensaje = $(this).attr("alt");
		$.msgbox($mensaje);

	});

	$('.msgbox-confirma').live ('click', function (e) {
		var $mensaje = $(this).attr("alt");
		var $url = $(this).attr("url");
		$.msgbox($mensaje, {
		  type: "confirm",
		  buttons : [
		    {type: "submit", value: "Aceptar"},
		    
		  ]
		}, function(result) {
			if(result){
				elimina();
			}
		});
		function elimina(){
			window.location=$url;
		}
	});


	$('.msgbox-info').live ('click', function (e) {
		$.msgbox("jQuery is a fast and concise JavaScript Library that simplifies HTML document traversing, event handling, animating, and Ajax interactions for rapid web development.", {type: "info"});
	});
	
	$('.msgbox-error').live ('click', function (e) {
		$.msgbox("An error 1053 ocurred while perfoming this service operation on the MySql Server service.", {type: "error"});
	});
	
	$('.msgbox-confirm').live ('click', function (e) {
		var $id = $(this).attr("alt");
		var $url = window.location.protocol + "//" + window.location.host + window.location.pathname + "?accion=eliminar&id=" + $id;
		$.msgbox("Estas seguro de eliminar permanentemente el registro: " + $id+" ?", {
		  type: "confirm",
		  buttons : [
		    {type: "submit", value: "Si"},
		    {type: "cancel", value: "No"},
		    {type: "cancel", value: "Cancelar"}
		  ]
		}, function(result) {
			if(result){
				elimina();
			}
		});
		function elimina(){
			window.location=$url;
		}
	});
	
	$('.msgbox-prompt').live ('click', function (e) {
		$.msgbox("Insert your name below:", {
		  type: "prompt"
		}, function(result) {
		  if (result) {
		    alert("Hello " + result);
		  }
		});
	});
	
});