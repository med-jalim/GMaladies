class Patient{

    UpId = document.getElementById('UpId');
    UpCne = document.getElementById('UpCne');
    UpPassword = document.getElementById('UpPassword');
    UpEmail = document.getElementById('UpEmail');
    UpNom = document.getElementById('UpNom');
    UpPrenom = document.getElementById('UpPrenom');
    UpDateNaissance = document.getElementById('UpDateNaissance');
    UpSexe = document.getElementById('UpSexe');
    UpAdresse = document.getElementById('UpAdresse');
    UpTele = document.getElementById('UpTele');
    UpPassword = document.getElementById('UpPassword');

    constructor(url){
        this.url=url;
        
    }

    async fetchPatients(value="",column="nom"){

       try {
        let reponse= await fetch(`${this.url}?column=${column}&value=${value}`);
        let result= await reponse.json();
        return result;
       } catch (error){
            console.log("error in fetchPatientn: ",error);
            return [];
       }
    }

    displayPatient(tbody,value="",column='nom'){
        tbody.innerHTML=""
        this.fetchPatients(value,column).then(patients=> 
        patients.forEach(patient => {

            let row=document.createElement('tr')
            row.innerHTML=`
                <tr>
                    <td>${patient.cne}</td>
                    <td>${patient.nom}</td>
                    <td>${patient.prenom}</td>
                    <td>${patient.date_naissance}</td>
                    <td>${patient.age}</td>
                    <td>${patient.sexe}</td>
                    <td>${patient.adresse}</td>
                    <td>${patient.telephone}</td>
                </tr>
            `
            row.addEventListener('click',()=>{

                UpId.value = patient.id;
                UpCne.value = patient.cne;
                UpPassword.value = "";
                UpEmail.value = patient.email;
                UpNom.value = patient.nom;
                UpPrenom.value = patient.prenom;
                UpDateNaissance.value = patient.date_naissance;
                UpSexe.value = patient.sexe;
                UpAdresse.value = patient.adresse;
                UpTele.value = patient.telephone;
                document.getElementById('Patient').style.transform = 'translate(-50%,-50%) scale(1)';

            })

            tbody.appendChild(row);
            
            
        })
    )
    };

    async deletePatient(user_id){

        try {
            let option= {
                method: 'DELETE', 
                headers: {
                    'Content-Type': 'application/json', 
                },
                body: JSON.stringify({
                    
                    id: Number(user_id)
                })
            }
            let reponse= await fetch(`${this.url}`,option);
            let result= await reponse.json();
            console.log(result)
        } catch (error){
            console.log("error in delete patient: ",error);
        }
     }

    async updatePatient(){

        try {
            let option= {
                method: 'PUT', 
                headers: {
                    'Content-Type': 'application/json', 
                },
                body: JSON.stringify({
                    id: Number(UpId.value),
                    cne: UpCne.value,
                    email: UpEmail.value,
                    nom: UpNom.value,
                    prenom: UpPrenom.value,
                    date_naissance: UpDateNaissance.value,
                    sexe: UpSexe.value,
                    adresse: UpAdresse.value,
                    telephone: UpTele.value
                })
            }
            let reponse= await fetch(`${this.url}`,option);
            if (!reponse.ok) {
                throw new Error(`HTTP Error! Status: ${reponse.status}`);
            }

            let result= await reponse.text();
            // let result=await reponse.json()
            
            
            console.log(result)
        } catch (error){
            console.log("error in  updatePatient: ",error  );
        }

        
    }
    async updatePassword(){

        try {
            let option= {
                method: 'PATCH', 
                headers: {
                    'Content-Type': 'application/json', 
                },
                body: JSON.stringify({
                    id: Number(UpId.value),
                    password:UpPassword.value
                })
            }
            let reponse= await fetch(`${this.url}`,option);
            if (!reponse.ok) {
                throw new Error(`HTTP Error! Status: ${reponse.status}`);
            }

            let result= await reponse.text();
            // let result=await reponse.json()
            
            
            console.log(result)
        } catch (error){
            console.log("error in  updatePatient: ",error  );
        }

        
     }

     async add(){

        try {
            let option= {
                method: 'POST', 
                headers: {
                    'Content-Type': 'application/json', 
                },
                body: JSON.stringify({
                    cne: UpCne.value,
                    email: UpEmail.value,
                    nom: UpNom.value,
                    prenom: UpPrenom.value,
                    date_naissance: UpDateNaissance.value,
                    sexe: UpSexe.value,
                    adresse: UpAdresse.value,
                    telephone: UpTele.value,
                    password:"123"
                })
            }
            let reponse= await fetch(`${this.url}`,option);
            if (!reponse.ok) {
                throw new Error(`HTTP Error! Status: ${reponse.status}`);
            }

            let result= await reponse.text();
            // let result=await reponse.json()
            
            
            console.log(result)
        } catch (error){
            console.log("error in  add patient: ",error  );
        }

        
     }

     

     

}



const currentPage=window.location.pathname.split("/")
currentPage.pop()
const basUrl=window.location.origin+currentPage.join('/')+"/"

// console.log( basUrl )


var patient=new Patient(basUrl+"api/patient_api.php")

