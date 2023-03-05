// JavaScript Document
function lo(th,url)
{
	$.ajax(url,{cache:false,success: function(x){$(th).html(x)}})
}
$(document).ready(()=>{
	$(".goods").on("click",function(){
		let user=$(this).data("user");
		let news=$(this).data("news");
		// siblings兄弟姊妹的意思。
		let total=parseInt($(this).siblings("p").text());
		console.log(user,news,total);
		$.post("./api/good.php",{user,news},(e)=>{
			console.log(e);
			if(e==0){
				$(this).text("收回讚");
				$(this).siblings("p").text(total+1)
			}
			if(e==1){
				$(this).text("讚");
				$(this).siblings("p").text(total-1)
			}
		})
	})
})