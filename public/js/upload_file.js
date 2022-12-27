
document.querySelector('.custom-file-input').addEventListener('change', function(e){
    var name = document.getElementById("sku_file").files[0].name;
    var nextSibling = e.target.nextElementSibling
    nextSibling.innerText = name

})
