var open=false;
var home=true;

//menu
function toggleNav() {
    document.getElementById("sidebar").classList.toggle("hidden");
    open=true;
  }
  
function checknumber(id){
  if(document.getElementById(id).value<0||document.getElementById(id).value==""){
    document.getElementById(id).value=0;
  }
}



//index
function indexupdateui(){
  const data=(localStorage.getItem('shoppinglist'))? JSON.parse(localStorage.getItem('shoppinglist')):{
    shoppingitem: []
  };
  var totalprice=0;
  for(var i =0;i<data.shoppingitem.length;i++){
    totalprice=data.shoppingitem[i].price+totalprice;
  }
  document.getElementById('shoppingpopup').innerHTML=""
  for(var i =0;i<data.shoppingitem.length;i++){
    document.getElementById('shoppingpopup').innerHTML+="<span class='eachdetail'>"+data.shoppingitem[i].name+"  x "+data.shoppingitem[i].number+"      $"+data.shoppingitem[i].price+"</span>";
    
  }
  document.getElementById('shoppingpopup').innerHTML+="<span class='eachdetail' style='border-top-color: black;border-top-width: 2px;border-top-style: solid'>Total: $"+totalprice+"</span>"
}

function productupdateui(pid){
  const data=(localStorage.getItem('shoppinglist'))? JSON.parse(localStorage.getItem('shoppinglist')):{
    shoppingitem: []
  };
  var totalprice=0;
  for(var i =0;i<data.shoppingitem.length;i++){
    totalprice=data.shoppingitem[i].price+totalprice;
  }
  document.getElementById('shoppingpopup').innerHTML=""
  for(var i =0;i<data.shoppingitem.length;i++){
    document.getElementById('shoppingpopup').innerHTML+="<span class='eachdetail'>"+data.shoppingitem[i].name+"  x "+data.shoppingitem[i].number+"      $"+data.shoppingitem[i].price+"</span>";
  }
  document.getElementById('shoppingpopup').innerHTML+="<span class='eachdetail' style='border-top-color: black;border-top-width: 2px;border-top-style: solid'>Total: $"+totalprice+"</span>"
  document.getElementById(pid+"number").value= data.shoppingitem[data.shoppingitem.findIndex(function(element){return element.id==pid})].number;
}

function addcart(number,pid){
  
  var str = JSON.stringify(pid);
  var xhr = new XMLHttpRequest();
  xhr.open('POST','./back-end/product/cartdata.php',true);
  xhr.setRequestHeader("Content-type","application/x-www-form-urlencoded");
  xhr.send("pid="+str);
  xhr.onreadystatechange = function(){
    var DONE=4;
    var OK=200;
    if(this.readyState==DONE && this.status==OK){
      var output=JSON.parse(xhr.responseText);
      var name= output.name;
      var price= output.price
      const data=(localStorage.getItem('shoppinglist'))? JSON.parse(localStorage.getItem('shoppinglist')):{
        shoppingitem: []
      };
      if(data.shoppingitem.findIndex(function(element){return element.id==pid})==-1){
        document.getElementById('cart'+number).innerHTML="<div class='numberrow'><button class='addnumber' onclick='addnumber("+number+","+pid+")'>+</button><input type='text' class='enternumber' id='productnumber"+number+"' value=1  onChange='changenumber("+number+","+pid+")'/><button class='minusnumber' onclick='minusnumber("+number+","+pid+")'>-</button></div>"
        const productdata={
          id:pid,
          name:name,
          price:price,
          number:1
        }
        data.shoppingitem.push(productdata);  
      }
      else{
        data.shoppingitem[data.shoppingitem.findIndex(function(element){return element.id==pid})].number++;
        data.shoppingitem[data.shoppingitem.findIndex(function(element){return element.id==pid})].price=data.shoppingitem[data.shoppingitem.findIndex(function(element){return element.id==pid})].price+price;
        document.getElementById('cart'+number).innerHTML="<div class='numberrow'><button class='addnumber' onclick='addnumber("+number+","+pid+")'>+</button><input type='text' class='enternumber' id='productnumber"+number+"' value="+ data.shoppingitem[data.shoppingitem.findIndex(function(element){return element.id==pid})].number+"  onChange='changenumber("+number+","+pid+")'/><button class='minusnumber' onclick='minusnumber("+number+","+pid+")'>-</button></div>"
      }
      localStorage.setItem('shoppinglist',JSON.stringify(data));
      indexupdateui();
    };
  }
}

function changenumber(number,pid){
  if(document.getElementById('productnumber'+number).value<0){
    document.getElementById('productnumber'+number).value=0;}
  var str = JSON.stringify(pid);
  var xhr = new XMLHttpRequest();
  xhr.open('POST','./back-end/product/cartdata.php',true);
  xhr.setRequestHeader("Content-type","application/x-www-form-urlencoded");
  xhr.send("pid="+str);
  xhr.onreadystatechange = function(){
    var DONE=4;
    var OK=200;
    if(this.readyState==DONE && this.status==OK){
      var output=JSON.parse(xhr.responseText);
      var name= output.name;
      var price= output.price;
      const data=(localStorage.getItem('shoppinglist'))? JSON.parse(localStorage.getItem('shoppinglist')):{
        shoppingitem: []
      };
      data.shoppingitem[data.shoppingitem.findIndex(function(element){return element.id==pid})].number=document.getElementById('productnumber'+number).value;
      data.shoppingitem[data.shoppingitem.findIndex(function(element){return element.id==pid})].price=document.getElementById('productnumber'+number).value*price;
      if(data.shoppingitem[data.shoppingitem.findIndex(function(element){return element.id==pid})].number==0){
        document.getElementById('cart'+number).innerHTML="<button class='addtocart' onclick='addcart("+number+","+pid+")'>Add</button>"
        data.shoppingitem.splice(data.shoppingitem.findIndex(function(element){return element.id==pid}),1)
      }
      localStorage.setItem('shoppinglist',JSON.stringify(data));
      indexupdateui();
    }
  }     
}

function addnumber(number,pid){
  
  
  document.getElementById('productnumber'+number).value++;
  var str = JSON.stringify(pid);
  var xhr = new XMLHttpRequest();
  xhr.open('POST','./back-end/product/cartdata.php',true);
  xhr.setRequestHeader("Content-type","application/x-www-form-urlencoded");
  xhr.send("pid="+str);
  xhr.onreadystatechange = function(){
    var DONE=4;
    var OK=200;
    if(this.readyState==DONE && this.status==OK){
      var output=JSON.parse(xhr.responseText);
      var name= output.name;
      var price= output.price;
      const data=(localStorage.getItem('shoppinglist'))? JSON.parse(localStorage.getItem('shoppinglist')):{
        shoppingitem: []
      };
      if(data.shoppingitem.findIndex(function(element){return element.id==pid})==-1){
        document.getElementById('productnumber'+number).value=1;
        document.getElementById('cart'+number).innerHTML="<div class='numberrow'><button class='addnumber' onclick='addnumber("+number+","+pid+")'>+</button><input type='text' class='enternumber' id='productnumber"+number+"' value=1  onChange='changenumber("+number+","+pid+")'/><button class='minusnumber' onclick='minusnumber("+number+","+pid+")'>-</button></div>"
        const productdata={
          id:pid,
          name:name,
          price:price,
          number:1
        }
        data.shoppingitem.push(productdata);  
      }
      else{
        data.shoppingitem[data.shoppingitem.findIndex(function(element){return element.id==pid})].number++;
        data.shoppingitem[data.shoppingitem.findIndex(function(element){return element.id==pid})].price=data.shoppingitem[data.shoppingitem.findIndex(function(element){return element.id==pid})].price+price;
      }
      localStorage.setItem('shoppinglist',JSON.stringify(data));
      indexupdateui();
    }
  }
}

function minusnumber(number,pid){
  document.getElementById('productnumber'+number).value--;

  if(document.getElementById('productnumber'+number).value<0){
    document.getElementById('productnumber'+number).value=0;
  }
  else{
    var str = JSON.stringify(pid);
    var xhr = new XMLHttpRequest();
    xhr.open('POST','./back-end/product/cartdata.php',true);
    xhr.setRequestHeader("Content-type","application/x-www-form-urlencoded");
    xhr.send("pid="+str);
    xhr.onreadystatechange = function(){
      var DONE=4;
      var OK=200;
      if(this.readyState==DONE && this.status==OK){
        var output=JSON.parse(xhr.responseText);
        var name= output.name;
        var price= output.price
        const data=(localStorage.getItem('shoppinglist'))? JSON.parse(localStorage.getItem('shoppinglist')):{
          shoppingitem: []
        };  
        data.shoppingitem[data.shoppingitem.findIndex(function(element){return element.id==pid})].number--;
        data.shoppingitem[data.shoppingitem.findIndex(function(element){return element.id==pid})].price=data.shoppingitem[data.shoppingitem.findIndex(function(element){return element.id==pid})].price-price;
        if(data.shoppingitem[data.shoppingitem.findIndex(function(element){return element.id==pid})].number==0){
          document.getElementById('cart'+number).innerHTML="<button class='addtocart' onclick='addcart("+number+","+pid+")'>Add</button>"
          data.shoppingitem.splice(data.shoppingitem.findIndex(function(element){return element.id==pid}),1)
        }
        localStorage.setItem('shoppinglist',JSON.stringify(data));
        indexupdateui();
      };
    }
  }
}

//product
function productchange(id,pid){
  if(document.getElementById(id).value<0){
    document.getElementById(id).value=0;
  }
  var str = JSON.stringify(pid);
  var xhr = new XMLHttpRequest();
  xhr.open('POST','./back-end/product/cartdata.php',true);
  xhr.setRequestHeader("Content-type","application/x-www-form-urlencoded");
  xhr.send("pid="+str);
  xhr.onreadystatechange = function(){
    var DONE=4;
    var OK=200;
    if(this.readyState==DONE && this.status==OK){
      var output=JSON.parse(xhr.responseText);
      var name= output.name;
      var price= output.price;
      const data=(localStorage.getItem('shoppinglist'))? JSON.parse(localStorage.getItem('shoppinglist')):{
        shoppingitem: []
      };
      if(data.shoppingitem.findIndex(function(element){return element.id==pid})==-1){
        const productdata={
          id:pid,
          name:name,
          price:price,
          number:document.getElementById(id).value
        }
        data.shoppingitem.push(productdata);           
      }
      else{
        data.shoppingitem[data.shoppingitem.findIndex(function(element){return element.id==pid})].number=document.getElementById(id).value;
        data.shoppingitem[data.shoppingitem.findIndex(function(element){return element.id==pid})].price=document.getElementById(id).value*price;
        if(data.shoppingitem[data.shoppingitem.findIndex(function(element){return element.id==pid})].number==0){
          data.shoppingitem.splice(data.shoppingitem.findIndex(function(element){return element.id==pid}),1)
        }
      }
      localStorage.setItem('shoppinglist',JSON.stringify(data));
      productupdateui(pid);
    }
  }   
}
function productadd(id,pid){
  var str = JSON.stringify(pid);
  var xhr = new XMLHttpRequest();
  xhr.open('POST','./back-end/product/cartdata.php',true);
  xhr.setRequestHeader("Content-type","application/x-www-form-urlencoded");
  xhr.send("pid="+str);
  xhr.onreadystatechange = function(){
    var DONE=4;
    var OK=200;
    if(this.readyState==DONE && this.status==OK){
      var output=JSON.parse(xhr.responseText);
      var name= output.name;
      var price= output.price;
      const data=(localStorage.getItem('shoppinglist'))? JSON.parse(localStorage.getItem('shoppinglist')):{
        shoppingitem: []
      };
      if(data.shoppingitem.findIndex(function(element){return element.id==pid})==-1){
        const productdata={
          id:pid,
          name:name,
          price:price,
          number:1
        }
        data.shoppingitem.push(productdata);  
        document.getElementById(id).value++;
      }
      else{
        document.getElementById(id).value++;
        data.shoppingitem[data.shoppingitem.findIndex(function(element){return element.id==pid})].number++;
        data.shoppingitem[data.shoppingitem.findIndex(function(element){return element.id==pid})].price=data.shoppingitem[data.shoppingitem.findIndex(function(element){return element.id==pid})].price+price;
      }
      localStorage.setItem('shoppinglist',JSON.stringify(data));
      productupdateui(pid);
    }
  } 
 }

 function productminus(id,pid){
  document.getElementById(id).value--;
  if(document.getElementById(id).value<0){
    document.getElementById(id).value=0
  }
  else{
    var str = JSON.stringify(pid);
    var xhr = new XMLHttpRequest();
    xhr.open('POST','./back-end/product/cartdata.php',true);
    xhr.setRequestHeader("Content-type","application/x-www-form-urlencoded");
    xhr.send("pid="+str);
    xhr.onreadystatechange = function(){
      var DONE=4;
      var OK=200;
      if(this.readyState==DONE && this.status==OK){
        var output=JSON.parse(xhr.responseText);
        var name= output.name;
        var price= output.price
        const data=(localStorage.getItem('shoppinglist'))? JSON.parse(localStorage.getItem('shoppinglist')):{
          shoppingitem: []
        };  
        data.shoppingitem[data.shoppingitem.findIndex(function(element){return element.id==pid})].number--;
        data.shoppingitem[data.shoppingitem.findIndex(function(element){return element.id==pid})].price=data.shoppingitem[data.shoppingitem.findIndex(function(element){return element.id==pid})].price-price;
        if(data.shoppingitem[data.shoppingitem.findIndex(function(element){return element.id==pid})].number==0){
          data.shoppingitem.splice(data.shoppingitem.findIndex(function(element){return element.id==pid}),1)
        }
        localStorage.setItem('shoppinglist',JSON.stringify(data));
        productupdateui(pid);
      };
    }
  }
}

 



 

  