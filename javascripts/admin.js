
function catergoryeditname(num){
    const previous =document.getElementById('name'+num).innerHTML;  
    document.getElementById('name'+num).innerHTML="<form action='../back-end/catorgory/edit.php' method='post'><input name='cid' type='hidden' value="+num+"></input><input type='text' value='"+previous+"' name='name' placeholder='Enter new name'/><button class='submitbutton' type='submit'><i class='fas fa-pencil-alt'></i></button></form>";
    document.getElementById('option'+num).innerHTML='';
}
function editproductname(num,token){
    const previous =document.getElementById('nameinput'+num).value;  
    document.getElementById('name'+num).innerHTML="<form action='../back-end/product/editname.php' method='post'><input type='hidden' name='csrftoken' value="+token+"/><input name='pid' type='hidden' value="+num+"></input><input name='oldname' type='hidden' value="+previous+"></input><input type='text' value='"+previous+"' name='name' placeholder='Enter new name'/><button class='submitbutton' type='submit'><i class='fas fa-pencil-alt'></i></button></form>";
    document.getElementById('option'+num).innerHTML='';
}
function editproductprice(num,token){
    const previous =document.getElementById('priceinput'+num).value;  
    document.getElementById('price'+num).innerHTML="<form action='../back-end/product/editprice.php' method='post'><input type='hidden' name='csrftoken' value="+token+"/><input name='pid' type='hidden' value="+num+"></input><input type='number' min='0' oninput='validity.valid||(value='');' value='"+previous+"' name='price' placeholder='Enter new price'/><button class='submitbutton' type='submit'><i class='fas fa-pencil-alt'></i></button></form>";
    document.getElementById('option'+num).innerHTML='';
}

function editproductimage(num,token){
    const productname =document.getElementById('nameinput'+num).value;
    document.getElementById('image'+num).innerHTML="<form action='../back-end/product/editimage.php' method='post' enctype='multipart/form-data'><input type='hidden' name='csrftoken' value="+token+"/><input name='name' type='hidden' value="+productname+"></input><input type='file' name='image'/> <button class='submitbutton' type='submit'><i class='fas fa-pencil-alt'></i></button><a href= './manageproduct.php'  class='submitbutton' ><i class='fas fa-times-circle'></i></form>";
}
function editproductdescription(num,token){
    const previous =document.getElementById('descriptioninput'+num).value;  
    document.getElementById('description'+num).innerHTML="<form action='../back-end/product/editdescription.php' method='post' ><input type='hidden' name='csrftoken' value="+token+"/><input name='pid' type='hidden' value="+num+"></input><input type='text' value='"+previous+"' name='description'/><button class='submitbutton' type='submit'><i class='fas fa-pencil-alt'></i></button></form>";
    document.getElementById('option'+num).innerHTML='';
}

