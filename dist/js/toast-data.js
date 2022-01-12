/*Toast Init*/


$(document).ready(function() {
	"use strict";
	
	$.toast({
		
		position: 'top-right',
		loaderBg:'#EA65A2',
		icon: 'error',
		hideAfter: 3000, 
		stack: 6
	});
	
	$('.tst1').on('click',function(e){
	    $.toast().reset('all'); 
		$("body").removeAttr('class');
		$.toast({
            
            position: 'top-right',
            loaderBg:'#EA65A2',
            icon: 'info',
            hideAfter: 50, 
            stack: 6
        });
		return false;
    });

	$('.tst2').on('click',function(e){
        $.toast().reset('all');
		$("body").removeAttr('class');
		$.toast({
            
            position: 'top-right',
            loaderBg:'#EA65A2',
            icon: 'warning',
            hideAfter: 50, 
            stack: 6
        });
		return false;
	});
	
	$('.tst3').on('click',function(e){
        $.toast().reset('all');
		$("body").removeAttr('class');
		$.toast({
            
            position: 'top-right',
            loaderBg:'#EA65A2',
            icon: 'success',
            hideAfter: 50, 
            stack: 6
          });
		return false;  
	});

	$('.tst4').on('click',function(e){
		$.toast().reset('all');
		$("body").removeAttr('class');
		$.toast({
            
            position: 'top-right',
            loaderBg:'#EA65A2',
            icon: 'error',
            hideAfter: 50
        });
		return false;
    });
	
	$('.tst5').on('click',function(e){
	    $.toast().reset('all');   
		$("body").removeAttr('class');
		$.toast({
            
            position: 'top-left',
            loaderBg:'#EA65A2',
            icon: 'error',
            hideAfter: 50
        });
		return false;
    });
	
	$('.tst6').on('click',function(e){
		$.toast().reset('all');
		$("body").removeAttr('class');
		$.toast({
            
            position: 'top-right',
            loaderBg:'#EA65A2',
            icon: 'error',
            hideAfter: 50
        });
		return false;
    });
	
	$('.tst7').on('click',function(e){
		$.toast().reset('all');
		$("body").removeAttr('class');
		$.toast({
            
            position: 'bottom-left',
            loaderBg:'#EA65A2',
            icon: 'error',
            hideAfter: 50
        });
		return false;
    });
	
	$('.tst8').on('click',function(e){
	    $.toast().reset('all');   
		$("body").removeAttr('class');
		$.toast({
           
            position: 'bottom-right',
            loaderBg:'#EA65A2',
            icon: 'error',
            hideAfter: 50
        });
		return false;
	});
	
	$('.tst9').on('click',function(e){
	    $.toast().reset('all');   
		$("body").removeAttr('class').removeClass("bottom-center-fullwidth").addClass("top-center-fullwidth");
		$.toast({
            
            position: 'top-center',
            loaderBg:'#EA65A2',
            icon: 'error',
            hideAfter: 50
        });
		return false;
	});
	
	$('.tst10').on('click',function(e){
	    $.toast().reset('all');
		$("body").removeAttr('class').addClass("bottom-center-fullwidth");
		$.toast({
            
            position: 'bottom-center',
            loaderBg:'#EA65A2',
            icon: 'error',
            hideAfter: 50
        });
		return false;
	});
});
          
