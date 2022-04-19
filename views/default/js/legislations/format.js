define(function(require) {
    var elgg = require("elgg");
    var $ = require("jquery");
    var base_url = window.location.origin;
   
   // const Swal = require(swalUrl);
    const Swal = require('../../../mod/legislation/node_modules/sweetalert2/dist/sweetalert2.all.min.js');
    //const Swal = require('https://cdn.jsdelivr.net/npm/sweetalert2@11')
    

function getFile(filePath) {
    return filePath.substr(filePath.lastIndexOf('\\') + 1).split('.')[0];
}
$("#project_draft").on('change', function(){

    outputfile = getFile(project_draft.value);
    extension = project_draft.value.split('.')[1];

    if(extension != 'pdf'){     
            document.getElementById('project_draft').value= null;
            Swal.fire({
            title: 'Error:',
            text: 'Only PDF files allowed',
            icon: 'error',
            allowOutsideClick: false,
            })
    }
});



});