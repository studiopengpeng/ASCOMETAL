		$(document).ready(function(){
			
			/* barre */
			$("#form_C").keyup(calcul);
			$('#form_Nm').keyup(calcul);
			$('#form_Ni').keyup(calcul);
			$('#form_Cu').keyup(calcul);
			$('#form_Mo').keyup(calcul);
			$('#form_Cr').keyup(calcul);
			$('#form_B').keyup(calcul);
			$('#form_V').keyup(calcul);
			$('#form_Si').keyup(calcul);

		});
		
		function calcul(){
				
				
				
				$C =  parseFloat($('#form_C').val());
				$Nm = parseFloat($('#form_Nm').val());
				$Ni = parseFloat($('#form_Ni').val());
				$Cu = parseFloat($('#form_Cu').val());
				$Mo = parseFloat($('#form_Mo').val());
				$Cr = parseFloat($('#form_Cr').val());
				$B =  parseFloat($('#form_B').val());
				$V =  parseFloat($('#form_V').val());
				$Si = parseFloat($('#form_Si').val());
			
			
			
			//alert( $C + '-' + $Nm + '-' + $Ni + '-' + $Cu + '-' + $Mo + '-' + $Cr + '-' + $B + '-' + $V + '-' + $Si);
			//if ($C <> NaN && $Nm <>NaN && $Cr <>NaN && $Mo <>NaN && V<>NaN && $Cu <>NaN && $Ni<>NaN &&)
			$cev = ($C + $Nm/6 + ($Cr + $Mo +$V)/5 + ($Cu + $Ni)/15); 
				
				
				//else $cev = 0;
				
				//if ($C <> NaN && $Nm <>NaN && $Cr <>NaN && $Mo <>NaN  && $Cu <>NaN && $Ni<>NaN)
				$cet = $C + ($Nm + $Mo)/10 +($Cr + $Cu)/20 + $Ni/40;
				//else $cet = 0;
				
				//if ($C <> NaN && $SI <>NaN && $Nm <>NaN && $Cu <>NaN && Cr<>NaN && $Ni <>NaN && $Mo<>NaN && $v<>Nan && $B<>NaN)
				$pcm = $C + $Si/30 + ($Nm + $Cu + $Cr)/20 + $Ni/60 + $Mo/15 + $V/10 + 5*$B;
				//else $pcm = 0;*/
				
				$('#form_barre_res_CEV').attr("value" ,  $cev.toFixed(3));
				$('#form_barre_res_CET').attr("value" ,  $cet.toFixed(3));
				$('#form_barre_res_Pcm').attr("value" ,  $pcm.toFixed(3));
			}
		
		
		