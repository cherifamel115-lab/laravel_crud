<!DOCTYPE html>
<html>
<head>
    <title>Articles</title>
    <!-- CSS DataTables -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    
    <!-- JS DataTables -->
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

    <!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- jQuery (déjà nécessaire pour DataTables) -->
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<!-- DataTables CSS/JS -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

</head>
<style>
/* ===== PAGE ===== */
body {
    background-color: #f8f1e9; /* beige clair */
    font-family: Arial, sans-serif;
}

/* ===== TITRE ===== */
h1 {
    text-align: center;
    font-weight: bold;
    color: #b76e79; /* rose doux */
    margin: 25px 0;
}

/* ===== TABLE ===== */
#articlesTable {
    width: 90%;
    margin: auto;
    border-collapse: collapse;
    background-color: #fffaf6;
    border-radius: 10px;
    overflow: hidden;
}

/* ===== HEADER ===== */
#articlesTable th {
    background-color: #f3c6cc; /* rose clair */
    color: #5a2a2a;
    font-weight: bold;
    padding: 12px;
    text-align: left;
}

/* ===== ROWS ===== */
#articlesTable td {
    padding: 10px;
    border-bottom: 1px solid #f0dede;
}

#articlesTable tr:hover {
    background-color: #fdecef;
}

/* ===== SEARCH ===== */
.dataTables_filter {
    width: 90%;
    margin: 20px auto;
    text-align: right;
}

.dataTables_filter label {
    font-weight: bold;
    color: #7a3e45;
}

.dataTables_filter input {
    margin-left: 8px;
    padding: 6px 10px;
    border-radius: 6px;
    border: 1px solid #e3b5bc;
}

/* ===== PAGINATION ===== */
.dataTables_paginate {
    width: 90%;
    margin: 20px auto;
    text-align: right;
}

.dataTables_paginate button {
    background-color: #f3c6cc !important;
    border: none !important;
    margin: 0 3px;
    padding: 6px 12px;
    border-radius: 6px;
    font-weight: bold;
    color: #5a2a2a !important;
}

.dataTables_paginate button.current {
    background-color: #b76e79 !important;
    color: white !important;
}

/* ===== INFO ===== */
.dataTables_info {
    width: 90%;
    margin: 10px auto;
    font-weight: bold;
    color: #7a3e45;
}
</style>




<body>
    <!-- Modal Ajouter Article -->
<div class="modal fade" id="addArticleModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form action="{{ route('articles.store') }}" method="POST">
        @csrf

        <div class="modal-header">
          <h5 class="modal-title">Ajouter un article</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>

        <div class="modal-body">
          <label>Titre</label>
          <input type="text" name="titre" class="form-control" required>

          <label class="mt-2">Catégorie</label>
          <input type="text" name="categorie" class="form-control" required>

          <label class="mt-2">Prix</label>
          <input type="number" step="0.01" name="prix" class="form-control" required>
           <label class="mt-2">Content</label>
          <input type="text" name="content" class="form-control" required>
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
          <button type="submit" class="btn btn-success">Ajouter</button>
        </div>

      </form>
    </div>
  </div>
</div>
<!-- Bouton Ajouter fixe -->
<button  class="btn btn-success rounded-circle" style="position: fixed; bottom: 30px; right: 30px; width: 60px; height: 60px; font-size: 30px; z-index: 999;"  data-bs-toggle="modal"  data-bs-target="#addArticleModal">+</button>
<h1>Articles</h1>
<table id="articlesTable" class="display">
    <thead>
        <tr>
            <th>ID</th>
            <th>Titre</th>
            <th>Catégorie</th>
            <th>Prix</th>
            <th>content</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($articles as $article)
        <tr>
            <td>{{ $article->id }}</td>
            <td>{{ $article->titre }}</td>
            <td>{{ $article->categorie }}</td>
            <td>{{ $article->prix }}</td>
            <td>{{ $article->content }}</td>
            <td>
                <!-- Bouton Modifier -->
                <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#editModal{{ $article->id }}">
                    Modifier✏️
                </button>

                <!-- Bouton Supprimer -->
                <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $article->id }}">
                    Supprimer 🗑️
                </button>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

@foreach ($articles as $article)
<div class="modal fade" id="editModal{{ $article->id }}" tabindex="-1" aria-labelledby="editModalLabel{{ $article->id }}" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form action="{{ route('articles.update', $article->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="modal-header">
          <h5 class="modal-title" id="editModalLabel{{ $article->id }}">Modifier l'article</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <label>Titre :</label>
          <input type="text" name="titre" class="form-control" value="{{ $article->titre }}"><br>
          <label>Catégorie :</label>
          <input type="text" name="categorie" class="form-control" value="{{ $article->categorie }}"><br>
          <label>Prix :</label>
          <input type="number" step="0.01" name="prix" class="form-control" value="{{ $article->prix }}">
          <label>content :</label>
          <input type="text"  name="content" class="form-control" value="{{ $article->content }}">
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
          <button type="submit" class="btn btn-primary">Modifier</button>
        </div>
      </form>
    </div>
  </div>
</div>
@endforeach
@foreach ($articles as $article)
<div class="modal fade" id="deleteModal{{ $article->id }}" tabindex="-1" aria-labelledby="deleteModalLabel{{ $article->id }}" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form action="{{ route('articles.destroy', $article->id) }}" method="POST">
        @csrf
        @method('DELETE')
        <div class="modal-header">
          <h5 class="modal-title" id="deleteModalLabel{{ $article->id }}">Supprimer l'article</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          Êtes-vous sûr de vouloir supprimer l'article <strong>{{ $article->titre }}</strong> ?
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
          <button type="submit" class="btn btn-danger">Supprimer</button>
        </div>
      </form>
    </div>
  </div>
</div>
@endforeach

<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script>
$(document).ready(function() {
    $('#articlesTable').DataTable({
        "paging": true,      // Pagination
        "searching": true,   // Barre de recherche
        "ordering": true     // Tri des colonnes
    });
});
</script>
</body>
</html>


