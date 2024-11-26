import 'jquery';
import '../select.js';
import Swal from '../sweetalert2.js';


   
   // const Swal = require(swalUrl);
   //RequireJS allows only strings in the require section. Otherwise it wont work.
  //  const Swal = import ('https://cdn.jsdelivr.net/npm/sweetalert2@11');
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

    
    const file = document.getElementById('project_draft');
    console.log(file.value);
 if(file.value != ' '){
    const outputfile = getFile(project_draft.value);
    const  extension = project_draft.value.split('.')[1];

        if(extension != 'pdf'){     
        //     document.getElementById('project_draft').value= null;
        
        file.value = "";
                messageHandler('Error:', 'Only PDF files allowed', 'info');
                console.log(file.value);
        }}
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



