<?php
include("config.php");
session_start();

if (!$_SESSION && !isset($_COOKIE['role'])) {
    redirect('auth/login.php');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion Maladies</title>
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/doctor.css">
    <script src="js/Patient.js"></script>
    <script defer src="js/doctor.js"></script>
</head>
<body>
    <div class="mainContainer container-fluid row min-vw-100">
        <!-- Sidebar -->
        <aside class="mainAside col-2 p-2 rounded-end-4">
            <div class="Asidelogo">
                <h5 class="fw-bold text-light m-2">Gestion Maladies</h5>
                <hr>
            </div>
            <a href="#" class="nav-link text-light w-100 text-center p-2 rounded active">Patients</a>
        </aside>

        <!-- Main Content -->
        <main class="main_centent col">
            <header class="w-100 p-4 shadow d-flex justify-content-between">
                <h4 class="fw-bold"><?php echo "Bonjour " . $_COOKIE['role']; ?></h4>
                <a href='auth/logout.php' class="btn btn-primary px-2 py-1">Logout</a>
            </header>

            <!-- Patient Management Section -->
            <div class="container p-4">
                <h2 class="mx-4 mb-1">Les patients</h2>
                <hr>

                <!-- Search and Add Section -->
                <div class="my-4 w-100 bg-light p-1 rounded-4">
                    <section class="row p-4">
                        <div class="col">
                            <input type="button" id="BtnAddPatient" value="Add patient" class="btn btn-primary py-1 px-2">
                        </div>
                        <div class="searchInput col-4 d-flex align-items-center gap-1">
                            <label for="searchPatient" class="fw-bold form-label">Search:</label>
                            <input type="text" name="search" id="searchPatient" class="form-control p-1">
                        </div>
                        <div class="columnSearch ms-1 col-2 d-flex align-items-center gap-1">
                            <label for="searchBy" class="fw-bold form-label">by:</label>
                            <select name="column" id="searchBy" class="form-select p-1">
                                <option value="nom" selected>Nom</option>
                                <option value="prenom">Prenom</option>
                                <option value="cne">CNE</option>
                                <option value="date_naissance">Date Naissance</option>
                                <option value="adresse">Adresse</option>
                                <option value="telephone">Téléphone</option>
                                <option value="sexe">Sexe</option>
                            </select>
                        </div>
                    </section>

                    <!-- Patient Table -->
                    <div class="table-container p-3">
                        <table class="table table-light table-hover table-responsive">
                            <thead>
                                <tr>
                                    <th>CNE</th>
                                    <th>Nom</th>
                                    <th>Prenom</th>
                                    <th>Date Naissance</th>
                                    <th>Age</th>
                                    <th>Sexe</th>
                                    <th>Adresse</th>
                                    <th>Téléphone</th>
                                </tr>
                            </thead>
                            <tbody id="table_body"></tbody>
                        </table>
                    </div>
                </div>

                <!-- Patient Form -->
                <div class="patient form bg-light rounded-5 px-4" id="Patient" style="transform:translate(-50%,-50%) scale(0);">
                    <header class="w-100 d-flex justify-content-end">
                        <button class="btn py-1 px-2" id="btnClosePatient">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-lg" viewBox="0 0 16 16">
                                <path d="M2.146 2.854a.5.5 0 1 1 .708-.708L8 7.293l5.146-5.147a.5.5 0 0 1 .708.708L8.707 8l5.147 5.146a.5.5 0 0 1-.708.708L8 8.707l-5.146 5.147a.5.5 0 0 1-.708-.708L7.293 8z"/>
                            </svg>
                        </button>
                    </header>
                    <form id="FormPatient" class="w-100 row gap-3 p-3">
                        <div class="col-3" name="UpPatient">
                            <label for="UpId" class="form-label">ID:</label>
                            <input type="text" name="inputFormPatient" id="UpId" class="form-control" disabled>
                        </div>
                        <div class="col-3">
                            <label for="UpCne" class="form-label">CNE:</label>
                            <input type="text" name="inputFormPatient" id="UpCne" class="form-control" required>
                        </div>
                        <div class="col-5">
                            <label for="UpEmail" class="form-label">Email:</label>
                            <input type="email" name="inputFormPatient" id="UpEmail" class="form-control" required>
                        </div>
                        <div class="col-3">
                            <label for="UpNom" class="form-label">Nom:</label>
                            <input type="text" name="inputFormPatient" id="UpNom" class="form-control" required>
                        </div>
                        <div class="col-3">
                            <label for="UpPrenom" class="form-label">Prenom:</label>
                            <input type="text" name="inputFormPatient" id="UpPrenom" class="form-control">
                        </div>
                        <div class="col-5">
                            <label for="UpDateNaissance" class="form-label">Date Naissance:</label>
                            <input type="date" name="inputFormPatient" id="UpDateNaissance" class="form-control" required>
                        </div>
                        <div class="col-3">
                            <label for="UpSexe" class="form-label">Sexe:</label>
                            <select name="inputFormPatient" id="UpSexe" class="form-select" required>
                                <option value="" disabled selected>Sexe</option>
                                <option value="Homme">Homme</option>
                                <option value="Femme">Femme</option>
                            </select>
                        </div>
                        <div class="col-3">
                            <label for="UpTele" class="form-label">Téléphone:</label>
                            <input type="number" name="inputFormPatient" id="UpTele" class="form-control">
                        </div>
                        <div class="col-5">
                            <label for="UpAdresse" class="form-label">Adresse:</label>
                            <input type="text" name="inputFormPatient" id="UpAdresse" class="form-control">
                        </div>
                        <div class="col-12 d-flex justify-content-center gap-3 mt-3">
                            <input type="submit" id="Enregistrer" name="UpPatient" value="Enregistrer" class="btn btn-primary">
                            <input type="submit" id="Ajouter" value="Ajouter" class="btn btn-primary w-25" style="display: none;">
                            <input type="button" value="Supprimer Patient" name="UpPatient" id="DeletePatient" class="btn btn-danger">
                            <input type="button" value="Modifier Mot de Passe" name="UpPatient" id="MdPassword" class="btn btn-warning">
                        </div>
                    </form>
                </div>

                <!-- Password Update Form -->
                <form id="formMdPassword" class="bg-light row text-center p-4 pt-2 rounded-4" style="display:none;">
                    <header class="w-100 d-flex justify-content-end">
                        <button class="btn" id="btnCloseFormMdPassword">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-lg" viewBox="0 0 16 16">
                                <path d="M2.146 2.854a.5.5 0 1 1 .708-.708L8 7.293l5.146-5.147a.5.5 0 0 1 .708.708L8.707 8l5.147 5.146a.5.5 0 0 1-.708.708L8 8.707l-5.146 5.147a.5.5 0 0 1-.708-.708L7.293 8z"/>
                            </svg>
                        </button>
                    </header>
                    <div class="container">
                        <div class="col">
                            <h6 class="fw-bold my-3">Entrer le nouveau mot de passe</h6>
                            <input type="text" id="UpPassword" class="form-control my-3 px-3 py-2" placeholder="Nouveau mot de passe" autocomplete="off" required>
                        </div>
                        <div class="col d-flex justify-content-center">
                            <input type="submit" value="Enregistrer" class="btn btn-primary px-3 py-2">
                        </div>
                    </div>
                </form>
            </div>
        </main>
    </div>

    
        
</body>
</html>
