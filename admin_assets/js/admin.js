	$(document).ready(function() {
			
				/* Ajax Uploading Image */
	$('body').on('change','#photoimg', function()
	{
	var values=$("#uploadvalues").val();
	$("#previeww").html('<img src="http://localhost/vehicle/vehicle/themes/vehicle/assets/img/loader.gif"/>');
	$("#imageform").ajaxForm({target: '#preview',
	 beforeSubmit:function(){
		 $("#imageloadstatus").show();
		 $("#imageloadbutton").hide();
		 },
		success:function(){
		 $("#imageloadstatus").hide();
		 $("#imageloadbutton").hide();
		},
		error:function(){
		 $("#imageloadstatus").hide();
		 $("#imageloadbutton").hide();
		} }).submit();
	
	});
	
		/* Uploading group Image */
	$('body').on('click','#camera', function()
	{
		$( "#photoimg" ).trigger( "click" );
	});
	
	$('body').on('click','#group-img-remove', function()
	{
		if(confirm('Conform to delete image'))
		{
			var img_name = $("input[name=uploadvalues]").val();
			var dataString = 'img_name='+ img_name ;
			$.ajax({
				type: "POST",
				url:baseurl+"admin/group/delete_image",
				data: dataString,
				cache: false,
				//beforeSend: function(){$("#friendstatus").html($.loaderIcon); },
				success: function(html)
				{
					if(html)
					{
						setTimeout(function(){ 
						
						$(".groupimage").fadeOut("slow");
						$("#uploadlink").fadeIn();
						$("input[name=uploadvalues]").val('');				
						}, 1000);
						setTimeout(function(){ 						
						$(".groupimage").remove("slow");								
						}, 1500);
						  
						
					}
				}
			});
		}
		return false;
	});
	
	$('body').on('click','#news-img-remove', function()
	{
		if(confirm('Conform to delete image'))
		{
			var img_name = $("input[name=uploadvalues]").val();
			var dataString = 'img_name='+ img_name ;
			$.ajax({
				type: "POST",
				url:baseurl+"admin/news/delete_image",
				data: dataString,
				cache: false,
				//beforeSend: function(){$("#friendstatus").html($.loaderIcon); },
				success: function(html)
				{
					if(html)
					{
						setTimeout(function(){ 
						
						$(".newsimage").fadeOut("slow");
						$("#uploadlink").fadeIn();
						$("input[name=uploadvalues]").val('');				
						}, 1000);
						setTimeout(function(){ 						
						$(".newsimage").remove("slow");								
						}, 1500);
						  
						
					}
				}
			});
		}
		return false;
	});
	
					/* Ajax Uploading Image */
	$('body').on('change','#bannerphotoimg', function()
	{
	var values=$("#uploadvalues").val();
	
	$("#bannerimageform").ajaxForm({target: '#img-preview',
	 beforeSubmit:function(){
		 $("#imageloadstatus").show();
		 $("#imageloadbutton").hide();
		 },
		success:function(){
		 $("#imageloadstatus").hide();
		 $("#imageloadbutton").hide(); 
		},
		error:function(){
		 $("#imageloadstatus").hide();
		 $("#imageloadbutton").hide();
		} }).submit();
	
	});
	
		/* Uploading Banner Image */
	$('body').on('click','#banner-image', function()
	{
		$( "#bannerphotoimg" ).trigger( "click" );
	});
	
	/* Remove Banner Image */
	$('body').on('click','#banner-img-remove', function()
	{
		if(confirm('Conform to delete image'))
		{
			var img_name = $("input[name=uploadvalues]").val();
			var dataString = 'img_name='+ img_name ;
			$.ajax({
				type: "POST",
				url:baseurl+"admin/banner/delete_image",
				data: dataString,
				cache: false,
				//beforeSend: function(){$("#friendstatus").html($.loaderIcon); },
				success: function(html)
				{
					if(html)
					{
						setTimeout(function(){ 
						
						$(".bannerimage").fadeOut("slow");
						$("#uploadlink").fadeIn();
						$("input[name=uploadvalues]").val('');				
						}, 1000);
						  
						
					}
				}
			});
		}
		return false;
	});
	
	$('body').on("click",'.accept',function(e){
		
		var vid = $(this).attr("rel");
		var gid = $('#'+vid).val();
		
		var dataString = 'uid='+ vid+'&gid='+gid;
		$.ajax({
		type: "POST",
		url:  baseurl+"admin/group/request_accept",
		data: dataString,
		cache: false,
		success: function(html){
			if(html){
				window.location	= baseurl +'admin/group/profile/'+gid;
			}
		 }
	  });
	
		return false;
	
	});
	
	$('body').on("click",'.reject',function(e){
		
		var vid = $(this).attr("rel");
		var gid = $('#'+vid).val();
		
		var dataString = 'uid='+ vid+'&gid='+gid;
		$.ajax({
		type: "POST",
		url:  baseurl+"admin/group/request_reject",
		data: dataString,
		cache: false,
		success: function(html){
			if(html){
				window.location	= baseurl +'admin/group/profile/'+gid;
			}
		 }
	  });
	
		return false;
	
	});
	
	$('body').on("click",'.change-status',function(e){
		
		var mid = $(this).attr("rel");
		var ID = $(this).attr("id");
		var temp = ID.split("-");		
		var status = temp[0];
		var dataString = 'mid='+ mid+'&status='+status;
		$.ajax({
		type: "POST",
		url:  baseurl+"admin/members/change_status",
		data: dataString,
		cache: false,
		success: function(html){
			if(html){
				
				if(status == 'enable')
				{
					$('#label-'+mid).addClass('label-success').removeClass('label-default');
					$('#label-'+mid).html('Active')	
					$('#btn-'+mid).removeClass('open')
					$('#'+status+'-'+mid).html('Disable').attr("id","disable-"+mid);	
					
				}
				else if(status == 'disable')
				{
					$('#label-'+mid).addClass('label-default').removeClass('label-success');
					$('#label-'+mid).html('Inactive')
					$('#btn-'+mid).removeClass('open')	
					$('#'+status+'-'+mid).html('Enable').attr('id','enable-'+mid);
				}
			}
		 }
	  });
	
		return false;
	
	});
	
	$('body').on("click",'.change-wall-status',function(e){
		
		
		var ID = $(this).attr("id");
		var temp = ID.split("-");		
		var status = temp[0];
		var wid = temp[1];
		var dataString = 'wid='+ wid+'&status='+status;
		$.ajax({
		type: "POST",
		url:  baseurl+"admin/members/change_wall_status",
		data: dataString,
		cache: false,
		success: function(html){
			if(html){
				
				if(status == 'enable')
				{
					$('#label-'+wid).addClass('label-success').removeClass('label-default');
					$('#label-'+wid).html('Active')	
					$('#btn-'+wid).removeClass('open')
					$('#'+ID).html('Disable').attr("id","disable-"+wid);	
					
				}
				else if(status == 'disable')
				{
					$('#label-'+wid).addClass('label-default').removeClass('label-success');
					$('#label-'+wid).html('Inactive')
					$('#btn-'+wid).removeClass('open')	
					$('#'+ID).html('Enable').attr('id','enable-'+wid);
				}
			}
		 }
	  });
	
		return false;
	
	});
	
	$('body').on("click",'.change-wall-comment-status',function(e){
		
		
		var ID = $(this).attr("id");
		var temp = ID.split("-");		
		var status = temp[0];
		var cid = temp[1];
		var dataString = 'cid='+cid+'&status='+status;
		$.ajax({
		type: "POST",
		url:  baseurl+"admin/memberwall/change_wall_comment_status",
		data: dataString,
		cache: false,
		success: function(html){
			if(html){
				
				if(status == 'enable')
				{
					$('#label-'+cid).addClass('label-success').removeClass('label-default');
					$('#label-'+cid).html('Active')	
					$('#btn-'+cid).removeClass('open')
					$('#'+ID).html('Disable').attr("id","disable-"+cid);	
					
				}
				else if(status == 'disable')
				{
					$('#label-'+cid).addClass('label-default').removeClass('label-success');
					$('#label-'+cid).html('Inactive')
					$('#btn-'+cid).removeClass('open')	
					$('#'+ID).html('Enable').attr('id','enable-'+cid);
				}
			}
		 }
	  });
	
		return false;
	
	});
	
	$('body').on("click",'.change-group-status',function(e){
		
		var gid = $(this).attr("rel");
		var ID = $(this).attr("id");
		var temp = ID.split("-");		
		var status = temp[0];
		var dataString = 'gid='+gid+'&status='+status;
		$.ajax({
		type: "POST",
		url:  baseurl+"admin/group/change_status",
		data: dataString,
		cache: false,
		success: function(html){
			if(html){
				
				if(status == 'enable')
				{
					$('#label-'+gid).addClass('label-success').removeClass('label-default');
					$('#label-'+gid).html('Active')	
					$('#btn-'+gid).removeClass('open')
					$('#'+status+'-'+gid).html('Disable').attr("id","disable-"+gid);	
					
				}
				else if(status == 'disable')
				{
					$('#label-'+gid).addClass('label-default').removeClass('label-success');
					$('#label-'+gid).html('Inactive')
					$('#btn-'+gid).removeClass('open')	
					$('#'+status+'-'+gid).html('Enable').attr('id','enable-'+gid);
				}
			}
		 }
	  });
	
		return false;
	
	});
	
	$('body').on("click",'.change-group-wall-status',function(e){
		
		var ID = $(this).attr("id");
		var temp = ID.split("-");		
		var status = temp[0];
		var gwid = temp[1];
		var dataString = 'gwid='+gwid+'&status='+status;
		$.ajax({
		type: "POST",
		url:  baseurl+"admin/group/change_group_wall_status",
		data: dataString,
		cache: false,
		success: function(html){
			if(html){
				
				if(status == 'enable')
				{
					$('#label-'+gwid).addClass('label-success').removeClass('label-default');
					$('#label-'+gwid).html('Active')	
					$('#btn-'+gwid).removeClass('open')
					$('#'+status+'-'+gwid).html('Disable').attr("id","disable-"+gwid);	
					
				}
				else if(status == 'disable')
				{
					$('#label-'+gwid).addClass('label-default').removeClass('label-success');
					$('#label-'+gwid).html('Inactive')
					$('#btn-'+gwid).removeClass('open')	
					$('#'+status+'-'+gwid).html('Enable').attr('id','enable-'+gwid);
				}
			}
		 }
	  });
	
		return false;
	
	});
	
	$('body').on("click",'.change-group-wall-comment-status',function(e){
		
		
		var ID = $(this).attr("id");
		var temp = ID.split("-");		
		var status = temp[0];
		var gid = temp[1];
		var dataString = 'gid='+gid+'&status='+status;
		$.ajax({
		type: "POST",
		url:  baseurl+"admin/groupwall/change_group_wall_comment_status",
		data: dataString,
		cache: false,
		success: function(html){
			if(html){
				
				if(status == 'enable')
				{
					$('#label-'+gid).addClass('label-success').removeClass('label-default');
					$('#label-'+gid).html('Active')	
					$('#btn-'+gid).removeClass('open')
					$('#'+ID).html('Disable').attr("id","disable-"+gid);	
					
				}
				else if(status == 'disable')
				{
					$('#label-'+gid).addClass('label-default').removeClass('label-success');
					$('#label-'+gid).html('Inactive')
					$('#btn-'+gid).removeClass('open')	
					$('#'+ID).html('Enable').attr('id','enable-'+gid);
				}
			}
		 }
	  });
	
		return false;
	
	});
	
	$('body').on("click",'.change-news-status',function(e){
		
		var nid = $(this).attr("rel");
		var ID = $(this).attr("id");
		var temp = ID.split("-");		
		var status = temp[0];
		var dataString = 'nid='+nid+'&status='+status;
		$.ajax({
		type: "POST",
		url:  baseurl+"admin/news/change_status",
		data: dataString,
		cache: false,
		success: function(html){
			if(html){
				
				if(status == 'enable')
				{
					$('#label-'+nid).addClass('label-success').removeClass('label-default');
					$('#label-'+nid).html('Active')	
					$('#btn-'+nid).removeClass('open')
					$('#'+status+'-'+nid).html('Disable').attr("id","disable-"+nid);	
					
				}
				else if(status == 'disable')
				{
					$('#label-'+nid).addClass('label-default').removeClass('label-success');
					$('#label-'+nid).html('Inactive')
					$('#btn-'+nid).removeClass('open')	
					$('#'+status+'-'+nid).html('Enable').attr('id','enable-'+nid);
				}
			}
		 }
	  });
	
		return false;
	
	});
	
	$('body').on("click",'.change-news-wall-status',function(e){
		
		var ID = $(this).attr("id");
		var temp = ID.split("-");		
		var status = temp[0];
		var nwid = temp[1];
		var dataString = 'nwid='+nwid+'&status='+status;
		$.ajax({
		type: "POST",
		url:  baseurl+"admin/news/change_news_wall_status",
		data: dataString,
		cache: false,
		success: function(html){
			if(html){
				
				if(status == 'enable')
				{
					$('#label-'+nwid).addClass('label-success').removeClass('label-default');
					$('#label-'+nwid).html('Active')	
					$('#btn-'+nwid).removeClass('open')
					$('#'+status+'-'+nwid).html('Disable').attr("id","disable-"+nwid);	
					
				}
				else if(status == 'disable')
				{
					$('#label-'+nwid).addClass('label-default').removeClass('label-success');
					$('#label-'+nwid).html('Inactive')
					$('#btn-'+nwid).removeClass('open')	
					$('#'+status+'-'+nwid).html('Enable').attr('id','enable-'+nwid);
				}
			}
		 }
	  });
	
		return false;
	
	});
	
	$('body').on("click",'.change-news-wall-comment-status',function(e){
		
		
		var ID = $(this).attr("id");
		var temp = ID.split("-");		
		var status = temp[0];
		var nid = temp[1];
		var dataString = 'nid='+nid+'&status='+status;
		$.ajax({
		type: "POST",
		url:  baseurl+"admin/newswall/change_news_wall_comment_status",
		data: dataString,
		cache: false,
		success: function(html){
			if(html){
				
				if(status == 'enable')
				{
					$('#label-'+nid).addClass('label-success').removeClass('label-default');
					$('#label-'+nid).html('Active')	
					$('#btn-'+nid).removeClass('open')
					$('#'+ID).html('Disable').attr("id","disable-"+nid);	
					
				}
				else if(status == 'disable')
				{
					$('#label-'+nid).addClass('label-default').removeClass('label-success');
					$('#label-'+nid).html('Inactive')
					$('#btn-'+nid).removeClass('open')	
					$('#'+ID).html('Enable').attr('id','enable-'+nid);
				}
			}
		 }
	  });
	
		return false;
	
	});
	
	$('body').on("click",'.change-blog-status',function(e){
		
		var bid = $(this).attr("rel");
		var ID = $(this).attr("id");
		var temp = ID.split("-");		
		var status = temp[0];
		var dataString = 'bid='+bid+'&status='+status;
		$.ajax({
		type: "POST",
		url:  baseurl+"admin/blogs/change_status",
		data: dataString,
		cache: false,
		success: function(html){
			if(html){
				
				if(status == 'enable')
				{
					$('#label-'+bid).addClass('label-success').removeClass('label-default');
					$('#label-'+bid).html('Active')	
					$('#btn-'+bid).removeClass('open')
					$('#'+status+'-'+bid).html('Disable').attr("id","disable-"+bid);	
					
				}
				else if(status == 'disable')
				{
					$('#label-'+bid).addClass('label-default').removeClass('label-success');
					$('#label-'+bid).html('Inactive')
					$('#btn-'+bid).removeClass('open')	
					$('#'+status+'-'+bid).html('Enable').attr('id','enable-'+bid);
				}
			}
		 }
	  });
	
		return false;
	
	});
		
		
	$('body').on("click",'#blog_m_category',function(e){
		
		
	
	});	
	
					/* Ajax Uploading Image */
	$('body').on('change','#blogcategoryphotoimg', function()
	{
	var values=$("#uploadvalues").val();
	
	$("#blogcategoryimageform").ajaxForm({target: '#img-preview',
	 beforeSubmit:function(){
		 $("#imageloadstatus").show();
		 $("#imageloadbutton").hide();
		 },
		success:function(){
		 $("#imageloadstatus").hide();
		 $("#imageloadbutton").hide();
		 
		 
		},
		error:function(){
		 $("#imageloadstatus").hide();
		 $("#imageloadbutton").hide();
		
		} }).submit();
	
	});
	
		/* Uploading Banner Image */
	$('body').on('click','#blog-category-image', function()
	{
		$( "#blogcategoryphotoimg" ).trigger( "click" );
	});
	
	/* Remove Banner Image */
	$('body').on('click','#blogcategory-img-remove', function()
	{
		if(confirm('Conform to delete image'))
		{
			var img_name = $("input[name=uploadvalues]").val();
			var dataString = 'img_name='+ img_name ;
			$.ajax({
				type: "POST",
				url:baseurl+"admin/blog_category/delete_image",
				data: dataString,
				cache: false,
				//beforeSend: function(){$("#friendstatus").html($.loaderIcon); },
				success: function(html)
				{
					if(html)
					{
						setTimeout(function(){ 
						
						$(".bannerimage").fadeOut("slow");
						$("#uploadlink").fadeIn();
						$("input[name=uploadvalues]").val('');				
						}, 1000);
						  
						
					}
				}
			});
		}
		return false;
	});
	
	$('body').on('change','.m-category', function()
	{
		var m_id = $(this).val();
		if(m_id == '2')
		{
			$('#blog-img').show();
		}
		else
		{
			$('#blog-img').hide();
		}
	
	});
	
	/* Remove Banner Image */
	$('body').on('click','.remove-album-image', function()
	{
		if(confirm('Conform to delete image'))
		{
			
			var rel = $(this).attr('rel');
			var sid = rel.split('-');
			var img_id = sid[0];
			var alb_id = sid[1]; 
			$('#'+img_id).addClass('loader');
			$('#album-'+img_id).addClass('opacty');
			var dataString = 'img_id='+ img_id+'&alb_id='+ alb_id ;
			$.ajax({
				type: "POST",
				url:baseurl+"admin/album/delete_image",
				data: dataString,
				cache: false,
				//beforeSend: function(){$("#friendstatus").html($.loaderIcon); },
				success: function(html)
				{
					if(html)
					{
						setTimeout(function(){
						$('#album-'+img_id).fadeOut('slow');				
						}, 1000);
						setTimeout(function(){
						$('#album-'+img_id).parent().remove();				
						}, 1500);
						  
						
					}
				}
			});
		}
		return false;
	});
	
	$('body').on("click",'.change-featured-status',function(e){
		
		var ID = $(this).attr("id");
		var temp = ID.split("-");		
		var status = temp[0];
		var bid = temp[1];
		var dataString = 'bid='+ bid+'&status='+status;
		$.ajax({
		type: "POST",
		url:  baseurl+"admin/blogs/change_featured",
		data: dataString,
		cache: false,
		success: function(html){
			if(html){
				
				if(status == 'featured')
				{
					$('#label-featured-'+bid).addClass('label-info').removeClass('label-default');
					$('#label-featured-'+bid).html('Featured');
					$('#btn-featured-'+bid).removeClass('open')
					$('#'+status+'-'+bid).html('Disable').attr("id","remove-"+bid);
				}
				else if(status == 'remove')
				{
					$('#label-featured-'+bid).addClass('label-default').removeClass('label-info');
					$('#label-featured-'+bid).html('Not Featured');
					$('#btn-featured-'+bid).removeClass('open')	
					$('#'+status+'-'+bid).html('Enable').attr('id','featured-'+bid);
				}
			}
		 }
	  });
	
		return false;
	
	});
	
	$('body').on("click",'.change-featured-status-member',function(e){
		
		var ID = $(this).attr("id");
		var temp = ID.split("-");		
		var status = temp[0];
		var mid = temp[1];
		var dataString = 'mid='+ mid+'&status='+status;
		$.ajax({
		type: "POST",
		url:  baseurl+"admin/members/change_featured",
		data: dataString,
		cache: false,
		success: function(html){
			if(html){
				
				if(status == 'featured')
				{
					$('#label-featured-'+mid).addClass('label-info').removeClass('label-default');
					$('#label-featured-'+mid).html('Featured');
					$('#btn-featured-'+mid).removeClass('open')
					$('#'+status+'-'+mid).html('Disable').attr("id","remove-"+mid);
				}
				else if(status == 'remove')
				{
					$('#label-featured-'+mid).addClass('label-default').removeClass('label-info');
					$('#label-featured-'+mid).html('Not Featured');
					$('#btn-featured-'+mid).removeClass('open')	
					$('#'+status+'-'+mid).html('Enable').attr('id','featured-'+bmidid);
				}
			}
		 }
	  });
	
		return false;
	
	});
	
	$('body').on("click",'.change-abuse-status',function(e){
		
		var aid = $(this).attr("rel");
		var ID = $(this).attr("id");
		var temp = ID.split("-");		
		var status = temp[0];
		var dataString = 'aid='+aid+'&status='+status;
		$.ajax({
		type: "POST",
		url:  baseurl+"admin/report/change_abuse_status",
		data: dataString,
		cache: false,
		success: function(html){
			if(html){
				
				if(status == 'completed')
				{
					$('#label-'+aid).addClass('label-success').removeClass('label-default');
					$('#label-'+aid).html('Completed')	
					$('#btn-'+aid).removeClass('open')
					$('#'+status+'-'+aid).html('Completed').attr("id","disable-"+aid);	
					
				}
				else if(status == 'pending')
				{
					$('#label-'+aid).addClass('label-default').removeClass('label-success');
					$('#label-'+aid).html('Pending')
					$('#btn-'+aid).removeClass('open')	
					$('#'+status+'-'+aid).html('Pending').attr('id','enable-'+aid);
				}
			}
		 }
	  });
	
		return false;
	
	});
});

