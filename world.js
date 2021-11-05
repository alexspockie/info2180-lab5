function initpage(){
	var button=document.getElementById("lookup");
	var button2=document.getElementById("lookupc");
	button.addEventListener("click",search);
	button2.addEventListener("click",searchCities);

}
function searchCities(event){
	event.preventDefault();
	var httpRequest =  new XMLHttpRequest();//making object
	var query=document.getElementById("country");
	httpRequest.onreadystatechange=function(){searchPhp(httpRequest);};
  httpRequest.open("GET","world.php?country="+query.value+"&context='cities'",true); //create request
  httpRequest.send(); //sending request

}
function search(event){
	event.preventDefault();
	var httpRequest =  new XMLHttpRequest();//making object
	var query=document.getElementById("country");
	httpRequest.onreadystatechange=function(){searchPhp(httpRequest);};
  httpRequest.open("GET","world.php?country="+query.value,true); //create request
  httpRequest.send(); //sending request
}
function searchPhp(httpRequest){
	if (httpRequest.readyState=== 4){
		if(httpRequest.status===200){
			var response=httpRequest.responseText;
			var result=document.getElementById("result");
			//alert(response);
			result.innerHTML=response;
			}
		else{
			alert("Problem");
		}
	}
}
document.addEventListener("DOMContentLoaded",function(){
	initpage();
});