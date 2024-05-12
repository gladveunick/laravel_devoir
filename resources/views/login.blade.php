<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <title>Connexion</title>
    <!-- <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }

        form {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            width: 300px;
        }

        h1 {
            text-align: center;
            color: #333;
        }

        label {
            display: block;
            margin-bottom: 8px;
        }

        input {
            width: 100%;
            padding: 8px;
            margin-bottom: 16px;
            box-sizing: border-box;
        }

        button {
            background-color: #3498db;
            color: #fff;
            padding: 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            width: 100%;
        }

        button:hover {
            background-color: #2980b9;
        }
    </style> -->
</head>

<body style="background-image: url('/images/bg.webp');background-size:cover;">


    <header class="header">
        <nav class="nav">
            <a href="#" class="nav_logo"><span style="color: yellow;">Sen</span> <span style="color:red;">Elections</span></a>

            <ul class="nav_items">
                <li class="nav_item">
                    <a href="#" class="nav_link">Accueil</a>
                    <a href="#" class="nav_link">Candidats</a>
                    <a href="#" class="nav_link">Contact</a>
                </li>
            </ul>

            <a href="{{ route('register') }}" class="button">Register</a>
        </nav>
    </header>

    <section class="home">
        <div class="form_container">
            <i class="uil uil-times form_close"></i>
            <!-- login formulaire -->

            <div class="form login_form">

                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <h2>Connexion</h2>
                    @if($errors->any())
                    <div style="color: red; text-align: center;">{{ $errors->first() }}</div>
                    @endif
                
                    <div class="input_box">
                        <input type="text" name="username" required placeholder="Nom d'utilisateur">
                        <i class="uil uil-envelope-alt"></i>
                    </div>

                    <div class="input_box">
                        <input type="password" name="password" required placeholder="Mot de passe">
                        <i class="uil uil-lock"></i>
                    </div>

                    <button type="submit" class="button">Login</button>

                    <div class="login_signup">Vous n'avez pas de compte ? <a href="{{ route('register') }}" id="signup">S'inscrire</a></div>
                </form>
            </div>
        </div>
    </section>



    <!-- ----------------------------------------------------------------------------------------------------- -->
    <!-- <form method="POST" action="{{ route('login') }}">
        @csrf
        <h1>Connexion</h1>

        @if($errors->any())
        <div style="color: red; text-align: center;">{{ $errors->first() }}</div>
        @endif

        <label for="username">Nom d'utilisateur :</label>
        <input type="text" name="username" required>

        <label for="password">Mot de passe :</label>
        <input type="password" name="password" required>

        <button type="submit">Se connecter</button>

        <p style="text-align: center; margin-top: 10px;">Vous n'avez pas de compte ? <a href="{{ route('register') }}">S'inscrire</a></p> -->
    </form>
</body>

</html>