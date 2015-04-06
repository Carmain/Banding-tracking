<h2 class="margin-title">Remplir une observation à propos d'un gravelot</h2>

<button id="explanation-button" class="btn btn-info">Comment remplir ce formulaire ?</button>
<div id="form-explanation" hidden="true">
    <p>
        La ligne des identifiants correspond à votre <b>nom</b> suivi de votre <b>prénom</b>. 
        Chacune de ses informations à une case propre.
    </p>
    <p>
        La date correspond à celle du jour où <b>l'observation a été réalisée</b>. 
        Par défault elle est instanciée à aujourd'hui.
    </p>
    <p>
        La localisation comporte 3 champs générés automatiquement. Si vous avez accordé <b>l'autorisation
        de vous géolocaliser</b> (généralement, un bandeau au-dessus de la page apparaît pour vous demander l'accord),
        les champs et la carte devraient donner des informations sur votre position actuelle. 

        Afin de géolocaliser votre observation, trois champs sont à remplir :
        <ul>
            <li>Le nom de la ville la plus proche où a été observé l'oiseau (Celui du dessus)</li>
            <li>Le lieu-dit (Celui à gauche)</li>
            <li>Le département (Celui à droite)</li>
        </ul>

        Pour plus d'aisance, il suffit de se déplacer dans la carte et de <b>cliquer sur l'endroit où l'oiseau a été aperçu</b>.
        Si les champs ne correspondent pas, merci de les corriger dans le formulaire. 
    </p>
    <p>
        Concernant l'inscription numérique, celle-ci est toujours sur une bague blanche. 
        La combinaison à reporter est donc composée du N° et de la couleur de la bague sur la patte opposée.
    </p>
    <p>
        En cas de bague manquante, merci de contacter <span class="mail-style">james.jb[at]wanadoo.fr</span> (n'oubliez pas de remplacer "[at]" par un "@")
    </p>
</div>

<form id="formdata" class="form-horizontal" role="form" method="post" action="core/request_plateform.php">
    
    <div class="form-group">
        <label class="control-label col-sm-2">Identifiants&nbsp;:</label>
        <div class="col-sm-5">
            <input type="text" class="form-control mandatory" name="last_name" placeholder="Nom">
        </div>
        <div class="col-sm-5">
            <input type="text" class="form-control mandatory" name="first_name" placeholder="Prénom">
        </div>
    </div>

    <div class="form-group">
        <label class="control-label col-sm-2">Date&nbsp;:</label>
        <div class="col-sm-10">
            <input type="text" class="form-control mandatory datepicker" name="date">
        </div>
    </div>
    
    <div class="form-group">
        <label class="control-label col-sm-2" for="pwd">Localisation&nbsp;:</label>
         <div class="col-sm-10">
            <input type="text" class="form-control mandatory" name="town" placeholder="Ville">
        </div>
    </div>
    
    <div class="form-group">
        <label class="control-label col-sm-2"></label>
        <div class="col-sm-5">
            <input type="text" class="form-control mandatory" name="location" placeholder="Lieu-dit">
        </div>
        <div class="col-sm-5">
            <input type="text" class="form-control mandatory" name="department_long" placeholder="Département">
        </div>
    </div>

    <div class="form-group"> <!-- map -->
        <label class="control-label col-sm-2"></label>
        <div class="col-sm-10">
            <div id="googleMap" class="map-form"></div>
        </div>

        <input type="hidden" name="department_short">
        <input type="hidden" name="mapX">
        <input type="hidden" name="mapY">
    </div>
    
    <div class="form-group">
        <label class="control-label col-sm-2">A propos de l'oiseau&nbsp;:</label>
        <div class="col-sm-4">
            <input type="number" class="form-control mandatory" name="numbers" placeholder="Code chiffré">
        </div>
        <div class="col-sm-4">
            <select class="form-control mandatory" name="color">
                <?php 
                    $colors = $db->get_unique_colors_rings();
                    while ($data = $colors->fetch()) {
                        if ($data["color"] != "") {
                            echo "<option>" . $data["color"] . "</option>";
                        }
                    }
                ?>
            </select>
        </div>
        <div class="col-sm-2">
            <select class="form-control mandatory" name="sex">
                <option>Mâle</option>
                <option>Femelle</option>
                <option>Indéterminé</option>
            </select>
        </div>
    </div>

    <div class="form-group">        
        <div class="col-sm-offset-2 col-sm-10">
            <button type="submit" class="btn btn-warning">Envoyer les données</button>
        </div>
    </div>
</form>