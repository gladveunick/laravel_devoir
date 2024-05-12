<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Lien css -->
    <link rel="stylesheet" href="{{ asset('css/utilisateur.css') }}">
    <!-- Lie icon -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>Détails du Candidat</title>
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
            background-image: url('https://source.unsplash.com/1200x800/?election');
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
    <a href="" class="logo"><span style="color:#ffffff;">Sen</span><span style="color:#d90429;">Election</span></a>
    <div class="bx bx-menu" id="menu-icon"></div>

    <ul class="navbar">
        <li><a href="">Accueil</a></li>
        <li><a href="">Candidats</a></li>
        <li><a href="">Contact</a></li>
        <li class="nav-item">
          <a class="nav-link" href="{{ route('user.dashboard') }}">Liste des candidats</a>
        </li>
    </ul>
</header>

<br>
<br>
<br>
<br>


<div class="container">
    <h1 class="text-center text-danger mt-4">Détails du Candidat :</h1>
    <table class="table table-bordered mt-4">
        <tbody>
            <tr>
                <th scope="row" >Nom</th>
                <td>{{ $candidat->nom }}</td>
            </tr>
            <tr>
                <th scope="row" >Prénom</th>
                <td>{{ $candidat->prenom }}</td>
            </tr>
            <tr>
                <th scope="row" >Parti politique</th>
                <td>{{ $candidat->parti }}</td>
            </tr>
            <tr>
                <th scope="row" >Biographie</th>
                <td>{{ $candidat->biographie }}</td>
            </tr>
        </tbody>
    </table>
    
    <h3 class="text-center mt-4 text-danger">Programmes Associés</h3>
    <table class="table table-bordered mt-4">
        <thead>
            <tr>
                <th scope="col" >Titre</th>
                <th scope="col" >Programmes</th>
                <th scope="col" >Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($programmes as $programme)
                <tr>
                    <td>{{ $programme->titre }}</td>
                    <td>
                    <a href="{{ Storage::url($programme->contenu) }}" target="_blank">Voir PDF</a>
                    </td>
                    <td>
                        <form action="{{ route('electeur.likeProgramme', $programme->id) }}" method="post">
                            @csrf
                            <button  type="submit" name="action" value="like" class="btn btn-success">J'aime {{ $programme->likes->count() }}</button>
                            <button type="submit" name="action" value="dislike" class="btn btn-danger">Je n'aime pas {{ $programme->dislikes->count() }}</button>
                        </form> 
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="3" class="text-center">Aucun programme associé</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

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


<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>
