import Dropzone from "dropzone";

document.addEventListener("DOMContentLoaded",function(){

    darkMode();   //Check dark mode habilitation
    mobileMenu(); //To show the menu icon in mobile design  
    dropzone();   //Initialize dropzone and add events
    reloadPage(); //Reload page when the user uses the browser back
    buttonDisabled(); //Submit form to send reset password email 

});


function darkMode(){

     let darkLocal = window.localStorage.getItem('dark');
     if(darkLocal === 'true') {
         document.documentElement.classList.add('dark');
     }

     document.querySelector('#dark-mode-button').addEventListener('click', darkChange);

}


//Change to dark mode or light mode
function darkChange(){

    let darkLocal = window.localStorage.getItem('dark');
 
    if(darkLocal === null || darkLocal === 'false') {
        //Set dark mode
        window.localStorage.setItem('dark', true);
        document.documentElement.classList.add('dark');
    } else {
        //Remove dark mode
        window.localStorage.setItem('dark', false);
        document.documentElement.classList.remove('dark');
    }

}


function mobileMenu(){

    if(document.querySelector(".mobile-menu")){

        document.querySelector(".mobile-menu").addEventListener("click",function(){

            const navegation = document.querySelector(".nav");
            ['flex', 'hidden'].map(className => navegation.classList.toggle(className));
           
        });

    }

}


function dropzone(){

    if(document.querySelector('#dropzone')){
    
        const dropzone = new Dropzone('#dropzone',{

            //Dropzone settings
            dictDefaultMessage: "Upload your image here",
            acceptedFiles: ".png,.jpg,.jpeg,.gif",
            addRemoveLinks: true,
            dictRemoveFile: 'Delete file',
            maxFiles: 1,
            uploadMultiple: false,

            init:function(){
                
                //If an image has been previously loaded
                if(document.querySelector('[name="image"]').value.trim()){

                    const imagenPublicada = {};
                    imagenPublicada.size = 1234;
                    imagenPublicada.name = document.querySelector('[name="image"]').value;

                    this.options.addedfile.call(this,imagenPublicada);
                    this.options.thumbnail.call(this,imagenPublicada,`/uploads/${imagenPublicada.name}`);

                    imagenPublicada.previewElement.classList.add('dz-success' , 'dz-complete');    

                }
            }

        });

        //If an image has been uploaded
        dropzone.on('success',function(file, response){
            document.querySelector('[name="image"]').value = response.image;
        });

        //If an image has been removed from the dropzone 
        dropzone.on('removedfile',function(){
            document.querySelector('[name="image"]').value = "";
        });
    }

}


function reloadPage(){

    window.addEventListener("pageshow", () => {

        let perfEntries = performance.getEntriesByType("navigation");
    
        if (perfEntries[0].type === "back_forward") {
            location.reload();
        }
    
    });

}


function buttonDisabled(){

    if(document.querySelector(".button-send-email")){

        document.querySelector(".button-send-email").addEventListener("click",function(e){

            const form = e.target.parentNode;

            e.target.setAttribute('disabled','');
            form.submit();
        });

    }

}






  