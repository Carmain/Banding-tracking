<h2>Remplir une observation à propos d'un gravelot</h2>
<form class="form-horizontal" role="form" method="post" action="core/request_plateform.php">
    
    <div class="form-group">
        <label class="control-label col-sm-2">Identifiants :</label>
        <div class="col-sm-5">
            <input type="text" class="form-control mandatory" name="last_name" placeholder="Nom">
        </div>
        <div class="col-sm-5">
            <input type="text" class="form-control mandatory" name="first_name" placeholder="Prénom">
        </div>
    </div>
    
    <div class="form-group">
        <label class="control-label col-sm-2" for="pwd">Localisation :</label>
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
            <div id="googleMap" style="width:100%;height:380px;"></div>
        </div>

        <input type="hidden" name="department_short">
        <input type="hidden" name="mapX">
        <input type="hidden" name="mapY">
    </div>
    
    <div class="form-group">
        <label class="control-label col-sm-2">A propos de l'oiseau :</label>
        <div class="col-sm-4">
            <input type="number" class="form-control mandatory" name="numbers" placeholder="Code chiffré et lettré">
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
            <select class="form-control mandatory">
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