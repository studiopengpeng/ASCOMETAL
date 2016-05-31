		$(document).ready(function(){
			
			/* messure */
			$('#form_longueur').keyup(longuueur);
			$('#form_unite1').change(longuueur);
			$('#form_unite2').change(longuueur);
				/* volume */
			$('#form_Volume').keyup(volume);
			$('#form_unite3').change(volume);
			$('#form_unite4').change(volume);
			
			/* Masse */
			$('#form_Masse').keyup(masse);
			$('#form_unite5').change(masse);
			$('#form_unite6').change(masse);
			
			/* surface */
			$('#form_Surface').keyup(surface);
			$('#form_unite7').change(surface);
			$('#form_unite8').change(surface);
			
			/* Densite */
			$('#form_Densite').keyup(densite);
			$('#form_unite9').change(densite);
			$('#form_unite10').change(densite);
			
			/* Contrainte */
			$('#form_Contrainte').keyup(contrainte);
			$('#form_unite11').change(contrainte);
			$('#form_unite12').change(contrainte);
			
			/* pression */
			$('#form_Pression').keyup(pression);
			$('#form_unite13').change(pression);
			$('#form_unite14').change(pression);
			
			/* Temperature */
			$('#form_Temperature').keyup(temperature);
			$('#form_unite15').change(temperature);
			$('#form_unite16').change(temperature);
			
						/* energie */
			$('#form_Energie').keyup(energie);
			$('#form_unite17').change(energie);
			$('#form_unite18').change(energie);
		});
		
		function longuueur(){
				
				$var = $('#form_longueur').val();
				$unite1 = $('#form_unite1').val();
				$unite2 = $('#form_unite2').val();
				
				if ( ($unite1 == 1)&&($unite2 == 2)) $var= parseFloat($var) * 3.2809;
				if ( ($unite1 == 2)&&($unite2 == 1)) $var= parseFloat($var) / 3.2809;
		
				if ($var.toFixed) $var = $var.toFixed(5);
				
				$('#form_longueur_res').attr("value" , $var);
				
				
				
			}
		
		function volume(){
				
				$var = $('#form_Volume').val();
				$unite1 = $('#form_unite3').val();
				$unite2 = $('#form_unite4').val();
				
				
				
				if ( ($unite1 == 1)&&($unite2 == 2)) $var= parseFloat($var) * 35.3146667;
				if ( ($unite1 == 2)&&($unite2 == 1)) $var= parseFloat($var) / 35.3146667;
				
				if ($var.toFixed) $var = $var.toFixed(5);
				
				$('#form_Volume_res').attr("value" , $var);
				
				
				
			}
			
		function masse(){
				
				$var = $('#form_Masse').val();
				$unite1 = $('#form_unite5').val();
				$unite2 = $('#form_unite6').val();
				
				
				
				if ( ($unite1 == 1)&&($unite2 == 2)) $var= parseFloat($var) * 2.20462262185;
				if ( ($unite1 == 2)&&($unite2 == 1)) $var= parseFloat($var) / 2.20462262185;
				
				if ($var.toFixed) $var = $var.toFixed(5);
				$('#form_Masse_res').attr("value" , $var);
				
			}
		function surface(){
				
				$var = $('#form_Surface').val();
				$unite1 = $('#form_unite7').val();
				$unite2 = $('#form_unite8').val();
				
				
				
				if ( ($unite1 == 1)&&($unite2 == 2)) $var= parseFloat($var) /  645.16;
				if ( ($unite1 == 2)&&($unite2 == 1)) $var= parseFloat($var) *  645.16;
				
				if ($var.toFixed) $var = $var.toFixed(5);
				$('#form_Surface_res').attr("value" , $var);
				
			}
			
		function densite(){
				
				$var = $('#form_Densite').val();
				$unite1 = $('#form_unite9').val();
				$unite2 = $('#form_unite10').val();
				
				
				
				if ( ($unite1 == 1)&&($unite2 == 2)) $var= parseFloat($var) /  27680;
				if ( ($unite1 == 2)&&($unite2 == 1)) $var= parseFloat($var) * 27680;
				
				if ($var.toFixed) $var = $var.toFixed(5);
				$('#form_Densite_res').attr("value" , $var);
				
			}
		function contrainte(){
				
				$var = $('#form_Contrainte').val();
				$unite1 = $('#form_unite11').val();
				$unite2 = $('#form_unite12').val();
				
				if ( ($unite1 == 1)&&($unite2 == 2)) $var= parseFloat($var) /  6.89474;
				if ( ($unite1 == 2)&&($unite2 == 1)) $var= parseFloat($var) *  6.89474;
				
				if ($var.toFixed) $var = $var.toFixed(5);
				$('#form_Contrainte_res').attr("value" , $var);
				
			}
			
		function pression(){
				
				$var = $('#form_Pression').val();
				$unite1 = $('#form_unite13').val();
				$unite2 = $('#form_unite14').val();
				
				if ($var.toFixed) $var = $var.toFixed(5);
				
				if ( ($unite1 == 1)&&($unite2 == 2)) $var= parseFloat($var) * 14.5038 ;
				if ( ($unite1 == 2)&&($unite2 == 1)) $var= parseFloat($var) /  14.5038 ;
				
				if ($var.toFixed) $var = $var.toFixed(5);
				$('#form_Pression_res').attr("value" , $var);
				
			}
		function temperature(){
				
				$var = $('#form_Temperature').val();
				$unite1 = $('#form_unite15').val();
				$unite2 = $('#form_unite16').val();
				
				if ( ($unite1 == 1)&&($unite2 == 2)) $var = (parseFloat($var)  * 1.8) + 32 ;
				if ( ($unite1 == 2)&&($unite2 == 1)) $var = (parseFloat($var) - 32 ) / 1.8;
				
				if ($var.toFixed) $var = $var.toFixed(5);
				$('#form_Temperature_res').attr("value" , $var);
				
			}
		function energie() {
				
				$var = $('#form_Energie').val();
				$unite1 = $('#form_unite17').val();
				$unite2 = $('#form_unite18').val();
				
				if ($var.toFixed) $var = $var.toFixed(5);
				
				if ( ($unite1 == 1)&&($unite2 == 2)) $var= parseFloat($var) / 1.35582;
				if ( ($unite1 == 2)&&($unite2 == 1)) $var= parseFloat($var) * 1.35582;
				
				if ($var.toFixed) $var = $var.toFixed(5);
				$('#form_Energie_res').attr("value" , $var);
				
			}