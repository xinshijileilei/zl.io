$(function(){
    $(".cpdq").on("mouseover",function(){
        $(".caipu").css("display","block");
    })
    $(".cpdq").on("mouseout",function(){
        $(".caipu").css("display","none")
    })
    $(".jkdq").on("mouseover",function(){
        $(".caipu1").css("display","block");
    })
    $(".jkdq").on("mouseout",function(){
        $(".caipu1").css("display","none")
    })
})
$(function(){
    $("#nav1>li").on("mouseover",function(){
        $(this).children("a").addClass("active")
        $(this).siblings("li").children("a").removeClass("active")
    })
})
$(function(){
    $.ajax({
        type:"post",
        url:"http://localhost/xm/public/index.php/index/index/scroll",
        dataType:"json",
        success:function(res){
            // console.log(res.data)
            for(var i = 0;i<12;i++){
                var obj = res.data[i];
                var images = $("<div class="+"swiper-slide slide1"+"><img src="+"/xm"+obj.scroll_img+"><div class="+"coures_title"+" ><h3>"+obj.scroll_name+"</h3><p>香气四益 &nbsp;好吃过瘾</P></div></div>");
                $(".wrapper1").append(images)
            }
            var swiper = new Swiper('.swiper1', {               
                slidesPerView:4,
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
                slidesOffsetBefore : 150,
                slidesOffsetAfter : 350, 
                loop : true,           
                autoplay:true,
                scrollbar: {                
                  el: '.swiper-scrollbar',
                  hide: true,
                },
                navigation: {
                    nextEl: '.swiper-button-next',
                    prevEl: '.swiper-button-prev',
                 },
              });
        }
    })
})

var timer = null;
function starMove() {
    var oDiv = document.getElementsByClassName("bg")[0]
    console.log(oDiv)
    timer = setInterval(function() {
        var sd = 1;
        if (oDiv.offsetLeft >= 1300) {
            clearInterval(timer);
        } else {
            oDiv.style.left = oDiv.offsetLeft + sd + 'px';
        }
    },
    30);
}
$(function(){
    $.ajax({
        type:"post",
        url:"http://localhost/xm/public/index.php/Index/cooking/pttype",
        dataType:"json",
        success:function(res){
            var list = res.data[0].search;
            for(var i = 0;i<list.length;i++){
                var node = $("<li id='"+list[i].pttype_id+"'>"+list[i].pttype_name+"</li>");
                $(".tab").append(node)
                var content = $("<div class='tab_item'></div>");
                $(".content").append(content)
            }
            $(".tab>li:first").addClass("active1")
            
            var first = $(".tab>li:first").attr("id")
            // console.log(first);
            $.ajax({
                type:"post",
                url:"http://localhost/xm/public/index.php/Index/cooking/index",
                data:{
                    pttype_id:first,
                },
                dataType:"json",
                success:function(result){
                    if(result.code==1){
                        var lis = result.data;
                        for(var j= 0;j<lis.length;j++){
                            var food = $("<li><a class='glyphicon glyphicon-stop'>"+lis[j].cooking_name+"</a><img src="+"/xm"+lis[j].cooking_img+"></li>");
                            $(".selected").append(food)
                            // console.log(lis[j].cooking_img)
                           
                        }
                    }
                }
            })
            $(".tab_item:first").addClass("selected")
            $(".tab>li").on("mouseover",function(){
                $(this).addClass("active1").siblings("li").removeClass("active1");
                var index = $(this).index();
                $(".tab_item:eq("+index+")").addClass("selected").siblings("div").removeClass("selected")
                var pttype_id = $(this).attr("id");
                // console.log(pttype_id)
                $.ajax({
                    type:"post",
                    url:"http://localhost/xm/public/index.php/Index/cooking/index",
                    data:{
                        pttype_id:pttype_id,
                    },
                    dataType:"json",
                    success:function(result){
                        $(".selected").children().remove();
                        if(result.code==1){
                            var lis = result.data;
                            for(var j= 0;j<lis.length;j++){
                                var food = $("<li><a class='glyphicon glyphicon-stop'>"+lis[j].cooking_name+"</a><img src="+"/xm"+lis[j].cooking_img+"></li>");
                                $(".selected").append(food);
                            }
                        }
                    }
                })
            })
        }
    })
})
// 第一种方法
//     $(function(){
//         $.ajax({
//             type:"post",
//             url:"http://localhost/xm/public/index.php/Index/course/mstype",
//             dataType:"json",
//             success:function(all){
//                 var tell = all.data[0].search
//                 var backk1 = $("<div class='swiper-slide'><div class='slide_content'></div></div>");
//              $(".wrapper2").append(backk1)
//             for(var i = 0;i<tell.length;i++){
//                 var gdcp = $("<span><a href='' id='"+tell[i].mstype_id+"'>"+tell[i].mstype_name+"</a></span>");
//                 $(".gdcp_tab").append(gdcp);
//             }
            
//             $(".gdcp_tab>span>a:first").addClass("actives1")
//             $(".swiper-slide:first").addClass("selected2")
//             var second = $(".gdcp_tab>span>a:first").attr("id")
//             $.ajax({
//                 type:"post",
//                 url:"http://localhost/xm/public/index.php/Index/course/index",
//                 data:{
//                     type_id:second,
//                     limit:8
//                 },
//                 dataType:"json",
//                 success:function(a){
//                     if(a.code==1){
//                         var tell2 = a.data;
//                         for(var j= 0;j<tell2.length;j++){
//                             var cp = $("<li><img src="+"/xm"+tell2[j].course_img+"><a class='biaoti'>"+tell2[j].course_name+"</a><br><a class='pinglun'>0评论 0人气</a><br><a class='shenghuo'>爱生活的馋猫</a></li>")
//                             $(".slide_content").append(cp)
//                         }
//                     }
//                 }
//             })
//             var swiper1 = new Swiper('.container2', {
//                 loop : true,           
//                 autoplay:true,
//                 navigation: {
//                 nextEl: '.swiper-button-next',
//                 prevEl: '.swiper-button-prev',
//               },
//         });
        
//             $(".gdcp_tab>span>a").on("mouseover",function(){
//                 $(this).addClass("actives1").siblings("span").children("a").removeClass("actives1");
//                 var index = $(this).index();
//                 $(".swiper-slide:eq("+index+")").addClass("selected2").siblings("div").removeClass("selected2")
//                 var type_id = $(this).attr("id");
//                 $(function asd(){
//                     $(".gdcp_tab>span>a").on("mouseover",function(){
//                        if($(this).attr("id")==3){
//                            $(".zxcp").html("最新")
//                        }else if($(this).attr("id")==6){
//                             $(".zxcp").html("今日")
//                        }else if($(this).attr("id")==8){
//                         $(".zxcp").html("七天")
//                        }
//                         else if($(this).attr("id")==9){
//                         $(".zxcp").html("更多菜谱 >")
//                         }
//                     })
//                 })
//                 $.ajax({
//                  type:"post",
//                  url:"http://localhost/xm/public/index.php/Index/course/index",
//                 data:{
//                    type_id:type_id
//                 },
//                  dataType:"json",
//                  success:function(a){
//                   if(a.code==1){
//                       var tell2 = a.data;
//                      for(var j= 0;j<tell2.length;j++){
//                        $(".selected1").children().remove();
//                           var cp = $("<li>"+tell2[j].course_name+"</li>")
//                           $(".selected1").append(cp)
//                       }
//                    }
//                  }
//               })
//             })
//           }
//       })
// })
// 第二种方法
$(function(){
	$.ajax({
		type:"post",
		url:"http://localhost/xm/public/index.php/Index/course/mstype",
		dataType:"json",
		success:function(result){
		 var lis = result.data[0].search;
		 for (var i = 0; i < lis.length; i++) {
		  var node = $("<div class='swiper-slide slides1' id='"+lis[i].mstype_id+"'><div class='zuixin'>"+lis[i].mstype_name+"</div><div class='zuixin1'></div></div>");
		  $(".wrapper2").append(node);
		 }
		 var first = $(".slides1:eq(0)").attr("id");
		 move(first);
		 function move(first){
		  $.ajax({
			   type:"post",
			   url:"http://localhost/xm/public/index.php/Index/course/index",
			   data:{
				type_id:first,
				limit:7
			   },
		   dataType:"json",
			   success:function(res){
                   console.log(res)
					var course = res.data;
					var suu = 0;
					for(var i = 0; i<course.length;i++){
						 var course_list = $("<div class='zui'><img src="+"/xm"+course[i].course_img+"><div class='zuixin2_2'><div  class='zuixin2_2_1'><div class='zuixin2_2_1_1'>"+course[i].course_name+"</div><div class='zuixin2_2_1_2'>0 评论 0 人气</div><div class='zuixin2_2_1_3'>爱生活的馋猫 Vip</div></div><div  class='zuixin2_2_2'><div class='zuixin2_2_2_1'><div></div><div>8步/大概30分钟</div></div><div class='zuixin2_2_2_2'><div></div><div>煮/家常味</div></div></div></div></div>");
						 $("#"+first).children(".zuixin1").append(course_list);
						//  console.log(course_list);
						 suu++;
					}
				   if(suu==course.length){
						 var course_list2 = $("<div class='zuixin2 vv vv_1'><div class='vv_1_1'>热门栏目推荐</div><div class='vv_1_2'><li>最新菜谱</li><li>家常菜</li><li>凉菜</li><li>素菜</li><li>早餐</li><li>乌发</li><li>高血压</li><li>烘焙</li><li>韩国料理</li><li>川菜</li><li>粤菜</li><li>湘菜</li><li>甜点</li></div><li class='vv_1_3'>进入菜谱大全 >></li></div>");
					 $("#"+first).children(".zuixin1").append(course_list2);
					}
			   }	
		  })
		 }
 var myswiper = new Swiper('.container2', {  
    //  autoplay:true,
    //  effect : 'flip',
	   on:{
		slideChangeTransitionStart: function(){
		   var index = this.activeIndex;
		   var first2=$(".slides1:eq("+index+")").attr("id");
		   var divs = $("#"+first2).siblings('div').children('.zuixin1');
		   divs.children('.zui').remove();
		   divs.children('.zuixin2').remove();
		   move(first2);
		},
	   },
	   
	   navigation: {
		  nextEl: '.swiper-button-next',
		  prevEl: '.swiper-button-prev',
	   },
 });
}
})
})