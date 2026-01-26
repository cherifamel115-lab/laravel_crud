
    <style>
        legend{
            color:black;
            font-family: Arial, Helvetica, sans-serif;
            font-weight: bold;
            padding: 0 10px;
            text-transform: capitalize;
        }
      
        
        body {
            font-family: Arial, Helvetica, sans-serif;
            background-color: palegoldenrod;
            margin: 0;
            padding: 40px;
        }
        h1 {
            text-align: center;
            font-weight: bold;
             color:  rgb(5, 90, 19);
        }
        button{
            color:black;
            background:pink;
        }
        hr{
            color:black;
            border-color: black;
             border-width: 0.09cm;
        }
        .container {
            max-width: 900px;
            margin: auto;
        }


        input, textarea {
            width: 100%;
            padding: 8px;
            margin-top: 5px;
            border-radius: 4px;
            border: 1px solid #ccc;
        }

        textarea {
            resize: vertical;
        }

        button {
            padding: 8px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }



        fieldset {
            border: 1px solid #ccc;
            padding: 15px;
            border-radius: 11px;
            border-color: black;
            border-width: 0.09cm;
            
        }

       

        label {
            font-weight: bold;
        }

         div{
            position: fixed;
            bottom: 0;
            right: 0;
            width: 250px;
            background: rgb(247, 241, 246);
            border: 1px solid #ccc;
            border: 1px solid #ddd;
            padding: 20px;
            box-shadow: -2px -2px 10px rgba(0, 0, 0, 0.1);
             z-index: 100;
         }
         h3,h4,p{
            font-weight: bold;
             color:  rgb(0, 0, 0);
         }

    </style>

<h1>Articles</h1>
<form method="POST" action="/articles">
@csrf
 <fieldset>
  <legend>créer un article</legend>
   <table>
    
    <tr>
        <td><label for="titre">Titre:</label></td>
         <td><input type="text" name="titre"></td>
    </tr>
    <tr>
        <td><label for="categorie">Categorie:</label></td>
        <td><input type="text" name="categorie"></td>
    </tr>
    <tr>
      <td><label for="content">content:</label></td>
      <td><input type="text" name="content"></td>
    </tr>
    <tr>
       <td><label for="prix">prix:</label></td>
        <td><input type="prix" name="prix"></td>
    </tr>
    <tr>
       <td colspand='2'><button type="submit" id="b">Ajouter</button></td> </tr>
</table>
    </fieldset>
</form>

<hr>


@if($articles->isEmpty())
    <p>Aucun article pour le moment.</p>
@else
    @foreach($articles as $article)
        <h3>Titre:{{ $article->titre }}</h3>
        <h4>Categorie:{{ $article->categorie }}</h4>
        <p>Content: {{ $article->content }}</p>
        <h4>Prix: {{ $article->prix }}</h4>

    <form method="POST" action="/articles/{{ $article->id }}">
        @csrf
        @method('DELETE')
        <button type="submit">Supprimer</button>
    </form>

    <hr>

@endforeach
@endif 
<div>
<form action="/articles/update" method="post">
    @csrf
    <fieldset>
        <legend>Modifier un article</legend>
        <table>
            <tr>
                <td><label for="titre">Titre:</label></td>
                <td><input type="text" name="titre"></td>
            </tr>
            <tr>
                <td><label for="categorie">Categorie:</label></td>
                <td><input type="text" name="categorie"></td>
            </tr>
            <tr>
                <td><label for="content">content:</label></td>
                <td><input type="text" name="content"></td>
            </tr>
             <tr>
                <td><label for="prix">prix:</label></td>
                <td><input type="prix" name="prix"></td>
            </tr>
            <tr>
                <td><button type="submit" id="modifier" >Modifier</button></td>
                <td><button type="reset">Annuler</button></td>
            </tr>
        </table>
    </fieldset>
</form>
</div>


