  <div class="col-md-12">
		<input class="hidden" type="radio" name="uVal" value="kg" checked required>
		
      <div class="form-group">
        <label class="control-label" for="gender">Gênero</label>
        <div class="input-group" style="width:100%">
          <div class="btn-group radio-group" style="width: 80%;">
            <label class="btn btn-primary not-active" style="width:50%"><input type="radio" name="sexoption" id="option1" value="M" required>Homem</label>
            <label class="btn btn-primary not-active" style="width:50%"><input type="radio" name="sexoption" id="option2" value="F" required>Mulher</label>
          </div>
        </div>
      </div>
	  	<hr>
	  		<div class="form-group">
		      <label for="age">Idade</label>
		      <input type="text" class="form-control" name="age" onkeypress="return SomenteNumeros(event);" maxlength="3">
		    </div>

	  		<div class="form-group">
		      <label for="weight">Peso (kg)</label>
		      <input type="text" class="form-control" name="weight" onkeypress="return SomenteNumero(event);" maxlength="6">
		    </div>

		    <div class="form-group">
		      <label for="height">Altura (cm)</span>
		      <input type="text" class="form-control"  name="height" onkeypress="return SomenteNumero(event);" maxlength="6">
		    </div>


		    <div class="bfatguide"> 
				<a id="f_close" href="#">Sair X</a>
				<strong>É assim que você calcula sua gordura corporal:</strong>
				<p>Para resultados mais precisos: Pergunte a um treinador certificado para fazê-lo por você, vá ao médico, com uma pinça ou outras formas mais profissionais.</p>
				<p>Mas se você quer fazê-lo rápido e sozinho, avalie esses pontos do seu corpo:
					<ul id="bodyf_widths">
						<?php //echo plugins_url( 'includes/bmibmr_bodyf.php' , __FILE__ ); ?>
						<li>Pescoço: <input id="neck_width" name="neck_width"> <small>cm ou polegada</small></li>
						<li>Cintura: <input id="waist_width" name="waist_width"> <small>cm ou polegada</small></li>
						<li>Quadril: <input id="hips_width" name="hips_width"> <small>cm ou polegada</small></li>
					</ul>
					<a href="#" id="bodyf_calc">Calcular minha massa corporal %</a>
				</p>
				</div>
 
		    <div class="bodyFat_cont" style="display:none;">
					<small><input readonly="readonly" checked="checked" type="checkbox" name="calculateauto" id="calculateauto">Deixe a calculadora extrapolar minha gordura corporal com base em dados inseridos (resultado do IMC) </small><br>
				</div>
	  		<hr>
        <div class="form-group">
          <label class="control-label" for="gender">Atividade física</label>
          <div class="input-group" style="width:100%">
            <div class="btn-group radio-group" style="width: 80%;">
              <label class="btn btn-primary not-active" style="width:50%"><input name="adalLevel" type="radio" value="1" required="required"> Nenhuma</label>
              <label class="btn btn-primary not-active" style="width:50%"><input name="adalLevel" type="radio" value="1.2" required="required">Sedentária</label>
            </div>
          </div>
        </div>
				
				<div class="form-group">
          <label class="control-label" for="gender">Aptidão</label>
          <div class="input-group" style="width:100%">
            <div class="btn-group radio-group" style="width: 80%;">
              <label class="btn btn-primary not-active" style="width:50%"><input name="adalLevel" type="radio" value="1.375" required="required">Ligeiramente ativo</label>
              <label class="btn btn-primary not-active" style="width:50%"><input name="adalLevel" type="radio" value="1.55" required="required">Moderadamente ativo</label>
            </div>
          </div>
        </div>
		      
				<div class="form-group">
          <label class="control-label" for="gender">Atleta ou intervalo diário rígido</label>
          <div class="input-group" style="width:100%">
            <div class="btn-group radio-group" style="width: 80%;">
              <label class="btn btn-primary not-active" style="width:50%"><input name="adalLevel" type="radio" value="1.725" required="required">Muito ativo</label>
              <label class="btn btn-primary not-active" style="width:50%"><input name="adalLevel" type="radio" value="1.9" required="required">Extra ativo</label>
            </div>
          </div>
        </div>
		</div>

<input type="hidden" class="form-control" id="bmrCheck" name="bmibmr" value="bmr">
<button type="submit" class="btn btn-default btn-primary calcbtn">Calcular</button>