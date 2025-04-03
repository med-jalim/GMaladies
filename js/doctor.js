const searchPatient = document.getElementById('searchPatient');
        const searchBy = document.getElementById('searchBy');
        const tbody = document.getElementById('table_body');
        const patientForm = document.getElementById('Patient');
        const btnAjouter=document.getElementById('Ajouter')



        // Add Patient Button
        document.getElementById('BtnAddPatient').addEventListener('click', () => {
            patientForm.style.transform = 'translate(-50%,-50%) scale(1)';
            document.querySelectorAll("div[name=UpPatient],input[name=UpPatient]").forEach(el => el.style.display = 'none');
            btnAjouter.style.display = 'block';
            document.querySelectorAll('input[name=inputFormPatient]').forEach(input => input.value = '');
        });

        // Close Patient Form
        document.getElementById('btnClosePatient').addEventListener('click', () => {
            
            patientForm.style.transform = 'translate(-50%,-50%) scale(0)';
            btnAjouter.style.display = 'none';
            document.querySelectorAll("div[name=UpPatient],input[name=UpPatient]").forEach(el => el.style.display = 'block');
        });

        // Patient Form Submission
        document.getElementById('FormPatient').addEventListener('submit', (event) => {
            
            const clickedSubmit = event.submitter;
            if (clickedSubmit.id === 'Enregistrer') {
                event.preventDefault();
                patient.updatePatient();
            } else if (clickedSubmit.id === 'Ajouter') {
                patient.add();
            }
            btnAjouter.style.display = 'none';
            patient.displayPatient(tbody, searchPatient.value, searchBy.value);
        });

        // Delete Patient
        document.getElementById('DeletePatient').addEventListener('click', () => {
            patient.deletePatient(document.getElementById('UpId').value);
            patientForm.style.transform = 'translate(-50%,-50%) scale(0)';
            patient.displayPatient(tbody, searchPatient.value, searchBy.value);
        });

        // Open Password Update Form
        document.getElementById('MdPassword').addEventListener('click', () => {
            document.getElementById('formMdPassword').style.display = 'block';
        });

        // Close Password Update Form
        document.getElementById('btnCloseFormMdPassword').addEventListener('click', () => {
            document.getElementById('formMdPassword').style.display = 'none';
        });

        // Password Update Form Submission
        document.getElementById('formMdPassword').addEventListener('submit', (event) => {
            event.preventDefault();
            patient.updatePassword();
            document.getElementById('UpPassword').value = '';
        });

        // Search Patients
        
        patient.displayPatient(tbody, searchPatient.value, searchBy.value);

        searchPatient.addEventListener('input', () => {
            patient.displayPatient(tbody, searchPatient.value, searchBy.value);
        });