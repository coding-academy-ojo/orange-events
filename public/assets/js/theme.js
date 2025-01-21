
function theme(theme){

  if(theme == "light"){
    document.querySelector("body").style.backgroundColor = "#fff";
    document.querySelector("body").style.color = "#000";
    document.querySelector("#contact").style.color = "#000";
    
  }
  else{
    console.log(theme)
    document.querySelector("body").style.backgroundColor = "#000";
    document.querySelector("body").style.color = "#fff";
    document.querySelector("#contact").style.color = "#fff";
  }

}