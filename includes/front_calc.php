<?php 

		$fromData_arr = $_POST;

			if ($fromData_arr['uVal'] == 'kg') {
				$weight = $fromData_arr['weight'];
				$height = $fromData_arr['height'];
				$weight = str_replace(',', '.', $weight);
				$height = str_replace('.', '', $height);
				$height = str_replace(',', '', $height);
				
				$bmiR = ($weight*10000)/(pow($height,2));
				$bmi = round($bmiR,2);

				$weight_lbs = round(($weight*2.2),2);
				$height_in = round(($height*0.393700787),2);
				$weight_str = $weight.' kg';
				$height_str = $height.' cm';
			}
			else {
				$bmiR = (($fromData_arr['weight']/(pow($fromData_arr['height'],2)))*703);
				$bmi = round($bmiR,2);

				$weight_kg = round(($fromData_arr['weight']/2.2),2);
				$height_cm = round(($fromData_arr['height']*2.54),2);
				$weight_str = $fromData_arr['weight'].' lbs or ('.$weight_kg.' kg)';
				$height_str = $fromData_arr['height'].' in or ('.$height_cm.' cm)';
			}

			//Body fat percentage based on entered data
				//(1.20 x BMI) + (0.23 x Age) - (10.8 x gender) - 5.4
				//If you are a male, your gender number is 1. If you are a female, your gender number is 0.

			if ($fromData_arr['calculateauto']) {
				
				if ($fromData_arr['sexoption'] == "M") {
					//$bodyfatP = (1.20 * $bmi) + (0.23 * $fromData_arr['age']) - (10.8 * 1) - 5.4;
					$gender_num = 1;
				}
				if ($fromData_arr['sexoption'] == "F") {
					$gender_num = 0;
				}

				$bodyfatP = (1.20 * $bmi) + (0.23 * $fromData_arr['age']) - (10.8 * $gender_num) - 5.4;
					//echo '<h4 style="color:red;">bodyfat %; '.$bodyfatP.'</h4>';

			}
			else {
				$bodyfatP ='';
			}
		
		//echo '--++ '.$fromData_arr['bmibmr'];
		$calc_choice = '';
		if ($fromData_arr['bmibmr'] == 'bmr') {
			////////////////////weight convert
			$bmr_weight = $fromData_arr['weight'];
			$bmr_weight = str_replace(',', '.', $bmr_weight);
//			$bmr_weight = str_replace('.', '', $bmr_weight);
			if ($fromData_arr['uVal'] == 'kg') {
				$bmr_weight = $bmr_weight;
			}
			else {
				$bmr_weight = $bmr_weight/(2.2);
			}

			//////////////////// Male/female Coefficient
			if ($fromData_arr['sexoption'] == 'M') { //if man
				$coefficient_mf = 1*$bmr_weight*24;
				
				//Lean factor multiplier
				$bodyfat = $bodyfatP;
				switch($bodyfat) {
				    case ($bodyfat>=10 && $bodyfat<=14):
				        $multiplier_factor = 1;
				        break;
				    case ($bodyfat>=15 && $bodyfat<=20):
				        $multiplier_factor = 0.95;
				        break;
				    case ($bodyfat>=21 && $bodyfat<=28):
				        $multiplier_factor = 0.90;
				        break;
				    case ($bodyfat>28):
				        $multiplier_factor = 0.90;
				        break;
				}
			}
			if ($fromData_arr['sexoption'] == 'F') { //if woman
				$coefficient_mf = 0.9*$bmr_weight*24;
				//Lean factor multiplier
				$bodyfat = $bodyfatP;
				switch($bodyfat) {
				    case ($bodyfat>=14 && $bodyfat<=18):
				        $multiplier_factor = 1;
				        break;
				    case ($bodyfat>=19 && $bodyfat<=28):
				        $multiplier_factor = 0.95;
				        break;
				    case ($bodyfat>=29 && $bodyfat<=38):
				        $multiplier_factor = 0.90;
				        break;
				    case ($bodyfat>38):
				        $multiplier_factor = 0.85;
				        break;
				}

			}

			$BMR = round($coefficient_mf*$multiplier_factor,2);
			$daily_burn = round($BMR*$fromData_arr['adalLevel'],2);
			//round(1.95583, 2);



			$calc_choice = '<strong>Taxa de Metabolismo Basal: '.$BMR.', </strong> Requisitos calóricos diários estimados : <strong>'.$daily_burn.'</strong><hr>';
		}
		else {
			$calc_choice = '<strong>Somente IMC</strong><hr>';
		}


		?>


		<div class="alert alert-info" role="alert">
	      <div class="uListbmibmr">
			<ul>
				<li>
					<?php 
						echo $calc_choice;
					 ?>
				</li>
				<li>Peso: <span><?php echo $weight_str; ?></span></li>
				<li>Altura: <span><?php echo $height_str; ?></span></li>
				<li>IMC: <span><?php echo $bmi; ?></span></li>
				<li>Gordura corporal: <span><?php echo $bodyfatP; ?> %</span></li>
			</ul>
		</div>
	    </div> 

