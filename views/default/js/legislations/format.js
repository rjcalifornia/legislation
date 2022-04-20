define(function(require) {
    var elgg = require("elgg");
    var $ = require("jquery");
    var base_url = window.location.origin;
   
   // const Swal = require(swalUrl);
   //RequireJS allows only strings in the require section. Otherwise it wont work.
    const Swal = require('../../../mod/legislation/node_modules/sweetalert2/dist/sweetalert2.all.min.js');
    //const Swal = require('https://cdn.jsdelivr.net/npm/sweetalert2@11')
    

function getFile(filePath) {
    return filePath.substr(filePath.lastIndexOf('\\') + 1).split('.')[0];
}

function messageHandler(type, message, icon){
    Swal.fire({
        title: type,
        text: message,
        icon: icon,
        allowOutsideClick: false,
        })
}

$("#project_draft").on('change', function(){

    outputfile = getFile(project_draft.value);
    extension = project_draft.value.split('.')[1];

    if(extension != 'pdf'){     
            document.getElementById('project_draft').value= null;
            messageHandler('Error:', 'Only PDF files allowed', 'info')
    }
});

$("#project_banner").on('change', function(){

    outputfile = getFile(project_banner.value);
    extension = project_banner.value.split('.')[1];
console.log(extension);
    if(extension !== 'png' && extension !== 'jpg'){     
            document.getElementById('project_banner').value= null;
            messageHandler('Error:', 'Only PNG or JPG files allowed', 'info')
    }

  
});



});