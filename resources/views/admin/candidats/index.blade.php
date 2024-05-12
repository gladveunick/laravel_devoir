<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
</head>

<body>
    <div class="sidebar">
        <div class="logo">
            <ul class="menu">
                <li class="active">
                    <a href="">
                        <i class="fas fa-tachometer-alt"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="">
                        <i class="fas fa-users "></i>
                        <span>Electeurs</span>
                    </a>
                </li>

                <li>
                    <a href="{{route('admin.candidats')}}">
                        <i class="fas fa-user-tie"></i>
                        <span>Candidats</span>
                    </a>
                </li>
                <li>
                    <a href="{{route('admin.programmes.index')}}">
                        <i class="fas fa-clipboard-list"></i>
                        <span>Programmes</span>
                    </a>
                </li>
                <li>
                    <a href="">
                        <i class="fas fa-cog"></i>
                        <span>Settings</span>
                    </a>
                </li>
                <li class="logout">
                    <a href="{{ route('login') }}">
                        <i class="fas fa-sign-out-alt"></i>
                        <span>Logout</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>

    <div class="main--content">
        <div class="header--wrapper">
            <div class="header--title">
                <span>Sen Election</span>
                <h2>Dashboard</h2>
            </div>
            <div class="user--info">
                <div class="search--box">
                    <i class="fa-solid fa-search"></i>
                    <input type="text" placeholder="search">
                </div>
                <img src="" alt="">
            </div>
        </div>

        <div class="card--container">
            <h3 class="main--title">Données en live</h3>
            <div class="card--wrapper">
                <div class="payment--card light-purple">
                    <div class="card--header">
                        <div class="amount">
                            <span class="title">
                                Nombre total de candidats
                            </span>
                            <span class="amount-value">
                                {{$totalCandidats}}
                            </span>
                        </div>
                        <i class="fas fa-user-tie icon dark-purple"></i>
                    </div>
                    <span class="card--detail">
                        **** **** **** 5542
                    </span>
                </div>
                <div class="payment--card light-green">
                    <div class="card--header">
                        <div class="amount">
                            <span class="title">
                                Nombre total d'electeurs
                            </span>
                            <span class="amount-value">
                                {{ $total_electeurs}}
                            </span>
                        </div>
                        <i class="fas fa-users icon dark-green"></i>
                    </div>
                    <span class="card--detail">

                        **** **** **** 7624
                    </span>
                </div>
                <div class="payment--card light-blue">
                    <div class="card--header">
                        <div class="amount">
                            <span class="title">
                                Nombre total de programmes
                            </span>
                            <span class="amount-value">
                                {{ $total_programmes}}
                            </span>
                        </div>
                        <i class="fas fa-clipboard-list icon dark-blue"></i>
                    </div>
                    <span class="card--detail">

                        **** **** **** 7624
                    </span>
                </div>
            </div>
        </div>
        <div class="tabular--wrapper">
            <h3 class="main--title">
                Liste des candidats
            </h3>
            <div class="table-container">
                <a href="{{ route('admin.dashboard') }}" class="btn btn-warning" style="margin-left: 30%;">Revenir au dashboard</a>
                <a href="{{ route('admin.candidats.add') }}" class="btnAjout"><i class="fas fa-plus"></i> Ajouter un Candidat

                </a>
                <br>
                <br>
                <table>
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Nom</th>
                            <th>Prénom</th>
                            <th>Parti</th>
                            <th>Biographie</th>
                            <th>Validité</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($candidats as $candidat)
                        <tr>
                            <td>{{ $candidat->id }}</td>
                            <td>{{ $candidat->nom }}</td>
                            <td>{{ $candidat->prenom }}</td>
                            <td>{{ $candidat->parti }}</td>
                            <td>{{ $candidat->biographie }}</td>
                            
                            <td>{{ $candidat->validite ? 'Valide' : 'Non Valide' }}</td>
                            <td class="btn-boutton">
                                <a href="{{ route('admin.candidats.edit', $candidat->id) }}" class="btnEditer">
                                    <i class="fas fa-pencil-alt"></i> Editer</a>
                                <form action="{{ route('admin.candidats.destroy', $candidat->id) }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Supprimer</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>

</html>

<!-- <div class="container">
        <h2>Liste des Candidats</h2>

        <table class="table">
            <thead>
                <tr>
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>Parti</th>
                    <th>Validité</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($candidats as $candidat)
                <tr>
                    <td>{{ $candidat->nom }}</td>
                    <td>{{ $candidat->prenom }}</td>
                    <td>{{ $candidat->parti }}</td>
                    <td>{{ $candidat->validite ? 'Valide' : 'Non Valide' }}</td>
                    <td>
                        <a href="{{ route('admin.candidats.edit', $candidat->id) }}" class="btn btn-primary">Modifier</a>
                    </td>
                    <td>
                        <form action="{{ route('admin.candidats.destroy', $candidat->id) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Supprimer</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <a href="{{ route('admin.candidats.add') }}" class="btn btn-success">Ajouter un Candidat</a>
        <a href="{{ route('admin.dashboard') }}" class="btn btn-warning">Revenir au dashboard</a>
    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script> -->
<!-- </body>

</html> -->