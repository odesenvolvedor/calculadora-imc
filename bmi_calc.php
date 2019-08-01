<!-- hidden plugin folder path -->
<span id="hiddenppath" data-Path="<?php echo plugins_url(); ?>">hiddenppath</span>

<div class="bootstrap-scope">
    <form id="bmibmrCalc" method="post" action="<?php echo plugins_url('bmibmr_calculations.php', __FILE__); ?>" >
        <div class="row">
            <div id="data-panel" class="col-md-8 well">
                <div class="col-md-12">
                    <input class="hidden" type="radio" name="uVal" value="kg" checked required>

                    <div class="form-group">
                        <label class="control-label" for="gender">Gênero</label>
                        <div class="input-group" style="width:100%">
                            <div class="btn-group radio-group" style="width: 100%;">
                                <label class="btn btn-primary not-active" style="width:50%"><input type="radio" name="sexoption" id="option1" value="M" required>Homem</label>
                                <label class="btn btn-primary not-active" style="width:50%"><input type="radio" name="sexoption" id="option2" value="F" required>Mulher</label>
                            </div>
                        </div>
                    </div>
                    <hr>
	  		<div class="form-group">
		      <label for="age">Idade</label>
                      <input type="text" class="form-control" name="age" onkeypress="return SomenteNumeros(event);" maxlength="3" required>
		    </div>

	  		<div class="form-group">
		      <label for="weight">Peso (Kg)</label>
                      <input type="text" class="form-control" name="weight" onkeypress="return SomenteNumero(event);" maxlength="6" required>
		    </div>

		    <div class="form-group">
		      <label for="height">Altura (Centímetros)</span>
		      <input type="text" class="form-control"  name="height" onkeypress="return SomenteNumero(event);" maxlength="6" required>
		    </div>

                    <div class="bodyFat_cont" style="display:none;">
                        <small><input readonly="readonly" checked="checked" type="checkbox" name="calculateauto" id="calculateauto">Deixe a calculadora extrapolar minha gordura corporal com base em dados inseridos (resultado do IMC) </small><br>
                    </div>
                    <hr>
                    <div class="form-group">
                        <label class="control-label" for="gender">Atividade física</label>
                        <div class="input-group" style="width:100%">
                            <div class="btn-group radio-group" style="width: 100%;">
                                <label class="btn btn-primary not-active" style="width:33.3%"><input name="adalLevel" type="radio" value="1" required="required"> Sedentária</label>
                                <label class="btn btn-primary not-active" style="width:33.3%"><input name="adalLevel" type="radio" value="1.375" required="required">Moderada</label>
                                <label class="btn btn-primary not-active" style="width:33.3%"><input name="adalLevel" type="radio" value="1.9" required="required">Intensa</label>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="text-center">
                    <input type="hidden" class="form-control" id="bmrCheck" name="bmibmr" value="bmr">
                    <button type="submit" class="btn btn-default btn-primary calcbtn">Calcular</button>
                </div>
            </div>
        </div>
    </form>
    <div class="calcValues"></div>
    <div id="calcFront" data-calcFront="<?php echo plugins_url('includes/front_calc.php', __FILE__); ?>" ></div>
    <div id="bmibmrRes" data-saveBDataURL="<?php echo plugins_url('bmibmr_saved.php', __FILE__); ?>" style="clear:both; margin-top:26px; border-top:3px solid #B4B4B4;width: 100%; padding-top: 12px;" >
    </div>
</div>