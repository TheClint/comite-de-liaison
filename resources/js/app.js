import './bootstrap';
import '../css/app.css'

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

// Sauvegarde en mémoire du département sélectionné, et attribution des collapses et selected pour le faire apparaitre et disparaitre avec son résumé
let departementSelected;
let resumeSelected;

const carteSVG = document.getElementById('franceSVG');

// dans le cas des pages autres que la page avec l'élement carte
if (carteSVG !== null){
    for(let i=1; i<carteSVG.childNodes.length; i=i+2){

        carteSVG.childNodes[i].addEventListener("click", ()=> {
            if(departementSelected!=null){
                resumeSelected.classList.add('collapse');
                departementSelected.classList.remove('selected');
            }
            
            resumeSelected = document.getElementById('departement'+carteSVG.childNodes[i].id.slice(3));
            departementSelected = carteSVG.childNodes[i];
            resumeSelected.classList.remove('collapse');
            departementSelected.classList.add('selected');
            document.getElementById('afficherSelect').selectedIndex = i/2+1;
        })
        
    }
    
    document.getElementById('afficherButton').addEventListener('click', ()=>{
        if(departementSelected!=null){
            resumeSelected.classList.add('collapse');
            departementSelected.classList.remove('selected');
        }
    
        resumeSelected = document.getElementById('departement'+carteSVG.childNodes[(document.getElementById('afficherSelect').selectedIndex)*2-1].id.slice(3));
        departementSelected = carteSVG.childNodes[(document.getElementById('afficherSelect').selectedIndex)*2-1];
       
        resumeSelected.classList.remove('collapse');
        departementSelected.classList.add('selected');
    });
}

const selecteurDemande = document.getElementById('selecteurDemande');

// dans le cas des pages autres que la page avec l'élement selecteurDemande

if (selecteurDemande !== null){
    const array = Array.from(selecteurDemande.children)
    let optionPrecedente = null;
    console.log(selecteurDemande[0]);
    array.forEach(element => {
        
        element.addEventListener("click", () => {
            if(optionPrecedente !== null){
                optionPrecedente.classList.add("d-none");
            }
            else{
                selecteurDemande.remove(0);
            }
            optionPrecedente = document.getElementById('paragraphe'+selecteurDemande.value);
            optionPrecedente.classList.remove("d-none");
        });

    });
  
}






