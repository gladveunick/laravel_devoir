<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Élections Présidentielles</title>
    <link rel="stylesheet" href="css/style2.css">
     <!-- Lien css -->
     <link rel="stylesheet" href="{{ asset('css/utilisateur.css') }}">
    <!-- Lie icon -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        /* Navbar */
        header {
            background-color: #343a40;
            padding: 20px 0;
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: fixed;
            top: 0;
            width: 100%;
            z-index: 1000;
        }

        .navbar {
            list-style-type: none;
            margin: 0;
            padding: 0;
            display: flex;
        }

        .navbar li {
            margin-right: 20px;
        }

        .navbar a {
            text-decoration: none;
            color: #ffffff;
            transition: color 0.3s ease;
        }

        .navbar a:hover {
            color: #f8f9fa;
        }

        .logo {
            color: #ffffff;
            font-size: 24px;
            font-weight: bold;
            margin-left: 10%;
        }

        /* Home Section */
        .home {
            background-image: url('../images/sup.jpg');
            background-size: cover;
            background-position: center;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            text-align: center;
            color: #ffffff;
        }

        .home h1 {
            font-size: 48px;
            margin-bottom: 20px;
        }

        .home p {
            font-size: 20px;
            margin-bottom: 40px;
        }

        .home-btn {
            background-color: #007bff;
            color: #ffffff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            text-decoration: none;
            transition: background-color 0.3s ease;
        }

        .home-btn:hover {
            background-color: #0056b3;
        }

        /* Candidats Section */
        .candidats {
            padding: 100px 0;
            background-color: #f8f9fa;
        }

        .candidats h2 {
            text-align: center;
            margin-bottom: 50px;
        }

        .card {
            border: none;
            transition: transform 0.3s ease;
        }

        .card:hover {
            transform: translateY(-5px);
        }

        .card-title {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 15px;
        }

        .card img {
            border-radius: 5px 5px 0 0;
        }
    </style>
</head>
<body>

<header>
    <a href="" class="logo"><span style="color:#ffffff;">Sen</span><span style="color:#fd052f;">Election</span></a>
    <div class="bx bx-menu" id="menu-icon"></div>

    <ul class="navbar">
        <li><a href="">Accueil</a></li>
        <li><a href="">Candidats</a></li>
        <li><a href="">Contact</a></li>
    </ul>
</header>

<section class="home" id="home">
    <div class="home-text">
        <br>
        <br>
        <h1 style="font-weight:bold;">Élection Présidentielle 2024</h1>
        <p style="font-weight:bold;">Votez pour le futur de notre pays</p>
        <a href="#" class="home-btn">Votez maintenant</a>
    </div>
</section>

<section class="candidats py-5">
    <div class="container">
        <br>
        <br>
        <br>

        <h2 text text-center>Liste des candidats</h2>
        <br>
        <br>
        <div class="row">
            @forelse ($candidats as $candidat)
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <img src="{{ asset('candidat-photos/' . $candidat->photo) }}" class="card-img-top" alt="{{ $candidat->prenom }} {{ $candidat->nom }}">
                        <div class="card-body">
                            <h5 class="card-title">{{ $candidat->prenom }} {{ $candidat->nom }}</h5>
                            <a href="{{ route('electeur.detailsCandidat', $candidat->id) }}" class="btn btn-primary">Voir les détails</a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col">
                    <div class="alert alert-warning" role="alert">
                        Aucun candidat disponible
                    </div>
                </div>
            @endforelse
        </div>
    </div>
</section>

<br>
<br>
<br>
<br>


 <!-- Footer section -->
 <section class="footer">
        <div class="footer-container container">
            <div class="footer-box">
                <a href="#" class="logo">Sen<span>Election</span></a>
                <div class="social">
                    <a href="#"><i class='bx bxl-facebook'></i></a>
                    <a href="#"><i class='bx bxl-twitter'></i></a>
                    <a href="#"><i class='bx bxl-instagram'></i></a>
                    <a href="#"><i class='bx bxl-youtube'></i></a>
                </div>
            </div>
            <div class="footer-box">
                <h3>Pages</h3>
                <a href="#">Accueil</a>
                <a href="#">Candidats</a>
                <a href="#">Contact</a>
            </div>
            <div class="footer-box">
                <h3>Legal</h3>
                <a href="#">Privacy</a>
                <a href="#">Refund Policy</a>
                <a href="#">Cookie Policy</a>
            </div>
            <div class="footer-box">
                <h3>Contact</h3>
                <p>United States</p>
                <p>Senegal</p>
                <p>France</p>
            </div>

        </div>

    </section>

    <!-- Copyright -->

    <div class="copyright">
        <p>&#169; SenElection All Right Reserved</p>
    </div>

</body>
</html>
