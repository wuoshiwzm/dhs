$(document).ready(function(){
	$('.hrefvalue').click(function(){
		if(confirm("请确认删除!")){
	var	Manageid=$(this).attr('hrefvalue');
       $.get("/portal/Delete_Manage/",{Manageid:Manageid},function(data){
    	   eval('var ret = ' + data);
    	   if(ret == "true"){
    		   var n = noty({
					text: '<span>操作成功!</span>',
					type: 'success',
					layout: 'topCenter',
					closeWith: ['hover','click','button']
				});
    		   setTimeout(function(){
    			   window.location.reload();
    		   },1000);
        	   }else {
        		   var n = noty({
   					text: '<span>操作失败!</span>',
   					type: 'success',
   					layout: 'topCenter',
   					closeWith: ['hover','click','button']
   				});

    	   }
    	  
           })
		}
		})  
})