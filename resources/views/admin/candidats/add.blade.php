<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>Document</title>
</head>
<body>
    

<div class="container">
        <h2>Ajouter un Candidat</h2>

        <form method="POST" action="{{ route('admin.candidats.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="nom">Nom:</label>
                <input type="text" id="nom" name="nom" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="prenom">Prénom:</label>
                <input type="text" id="prenom" name="prenom" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="parti">Parti:</label>
                <input type="text" id="parti" name="parti" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="biographie">Biographie:</label>
                <textarea id="biographie" name="biographie" class="form-control" required></textarea>
            </div>

            <div class="form-group">
                <label for="validite">Validité:</label>
                <select id="validite" name="validite" class="form-control" required>
                    <option value="1">Valide</option>
                    <option value="0">Non Valide</option>
                </select>
            </div>

            <div class="form-group">
                <label for="photo">Photo:</label>
                <input type="file" id="photo" name="photo" class="form-control" accept="image/*">
            </div>

            <button type="submit" class="btn btn-primary">Ajouter</button>
            
             <a href="{{ route('admin.candidats') }}" class="btn btn-secondary">Retour à la liste des candidats</a>
        </form>

    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>