jQuery(document).ready(function() {

	
/* Navigation */
	jQuery('#submenu ul.sfmenu').superfish({ 
		delay:       500,								// 0.1 second delay on mouseout 
		animation:   { opacity:'show',height:'show'},	// fade-in and slide-down animation 
		dropShadows: true								// disable drop shadows 
	});	
	

/* Hover block */

	jQuery('.portfolio-box').hover(function(){
			jQuery(this).children('div').animate({height:'150'},{queue:false,duration:500});
	}, function(){
			jQuery(this).children('div').animate({height:'70'},{queue:false,duration:500});
		});

	
/* equal column	 */
	
	  var biggestHeight = 0;  
    //check each of them  
    jQuery('.equal_height').each(function(){  
        //if the height of the current element is  
        //bigger then the current biggestHeight value  
        if(jQuery(this).height() > biggestHeight){  
            //update the biggestHeight with the  
            //height of the current elements  
            biggestHeight = jQuery(this).height();  
        }  
    });  
    //when checking for biggestHeight is done set that  
    //height to all the elements  
    jQuery('.equal_height').height(biggestHeight);  
	
	





});
