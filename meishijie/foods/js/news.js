$(function(){
	$.ajax({
		type:'post',
		url:"http://localhost/xm/public/index.php/Index/yy/yytype",
		dataType:'json',
		success:function(result){
			var list=result.data;
			// console.log(list);
			for(var i=0;i<result.data.length;i++){
				var node=$("<div class='news'><div class='news_left'></div><div class='news_right'><li><a href='#'></a></li><li><a href='#'></a></li><li><a href='#'></a></li></div><div class='news_div_top'><a href='#'>"+list[i].yytype_name+"</a></div><div class='news_div_top1'></div></div>");
				$('.col-md-11').append(node);
			}
			jia(1,0);
			jia(2,1);
			jia(3,2);
			jia(4,3);
			function jia(yytype_id,id){
				$.ajax({
				type:'post',
				url:"http://localhost/xm/public/index.php/Index/yy/index",
				dataType:'json',
				data:{
					yytype_id:yytype_id,
					limit:3
				},
				success:function(res){
					// console.log(res.data)
					var lis=res.data;
					for(var j=0;j<res.data.length;j++){
						var imgs=$("<img src="+'/xm'+lis[j].yyarticle_img+">");
						$('.news_right:eq("'+id+'")>li:eq(0)>a').html(""+lis[0].yyarticle_title+"");
						$('.news_right:eq("'+id+'")>li:eq(1)>a').html(""+lis[1].yyarticle_title+"");
						$('.news_right:eq("'+id+'")>li:eq(2)>a').html(""+lis[2].yyarticle_title+"");
						$('.news:eq("'+id+'")>div:eq(0)').append(imgs);
					}
					$('.news:eq("'+id+'")>div:eq(0)>img:eq(0)').addClass('news_img_show');
				}
			})

			}
			slide(0);
			slide(1);
			slide(2);
			slide(3);
			function slide(a){
				$('.news_right:eq("'+a+'")>li').on('mouseover',function(){
				$(this).children('a').css('font-size','16px').css('color','red').css('font-weight','900');
				$(this).siblings('li').children('a').css('font-size','14px').css('color','#666').css('font-weight','300');
				var index=$(this).index();
				$('.news:eq("'+a+'")>div:eq(0)>img:eq('+index+')').addClass('news_img_show').siblings('img').removeClass('news_img_show')
				
			});
			$('.news_right:eq("'+a+'")>li').on('mouseout',function(){
				$(this).children('a').css('font-size','16px').css('color','black').css('font-weight','900');
			})
			}		
		}
	})
})
$(function(){
	$(".flow").on("mouseover",function(){		
			$(this).css('height','65px')	
	})	
	$(".flow").on("mouseout",function(){
		$(this).css('height','12px')
		
	})
})	
$(".back").on("click",function(){
	scroll(0,0)
})

