		$(document).ready(function(){
			
			/* barre */
			$('#form_barre').keyup(barre);
			
			/* billette */
			$('#form_billetes').keyup(billetes);
			
			/* larget */
			$('#form_larget_haut').keyup(larget);
			$('#form_larget_larg').keyup(larget);
			
			$('#form_barre2').keyup(barre2);
			$('#form_barre2_long').keyup(barre2);
			/* billette */
			$('#form_billetes2').keyup(billetes2);
			$('#form_billetes2_long').keyup(billetes2);
			/* larget */
			$('#form_larget2_haut').keyup(larget2);
			$('#form_larget2_larg').keyup(larget2);
			$('#form_larget2_long').keyup(larget2);

		});
		
		function barre(){
				
				$var = $('#form_barre').val();
				
				$var= (parseFloat($var)/2000) * (parseFloat($var)/2000) * 3.1415 * 7850;
				
				$('#form_barre_res').attr("value" , $var.toFixed(2));
				
			}
		
		function billetes(){
				
				$var = $('#form_billetes').val();
				$var= (parseFloat($var)/1000) * (parseFloat($var)/1000)  * 7850;
				
				
				$('#form_billetes_res').attr("value" , $var.toFixed(2));		
				
			}
			
		function larget(){
				
				$haut = $('#form_larget_haut').val();
				$lar = $('#form_larget_larg').val();
				
				$var= (parseFloat($lar)/1000) * (parseFloat($haut)/1000)  * 7850;
				
				
				$('#form_larget_res').attr("value" , $var.toFixed(2));
				
			}
			
		function barre2(){
				
				$var = $('#form_barre2').val();
				$long = $('#form_barre2_long').val();
				$var= (parseFloat($var)/2000) * (parseFloat($var)/2000) * 3.1415 * 7.850 * $long;
				
				$('#form_barre2_res').attr("value" , $var.toFixed(2));
				
			}
		
		function billetes2(){
				
				$var = $('#form_billetes2').val();
				$long = $('#form_billetes2_long').val();
				
				$var= ((parseFloat($var)/1000) * (parseFloat($var)/1000)  * 7850 * $long)/1000;
				
				
				$('#form_billetes2_res').attr("value" , $var.toFixed(2));		
				
			}
			
		function larget2(){
				
				$haut = $('#form_larget2_haut').val();
				$lar = $('#form_larget2_larg').val();
				$long = $('#form_larget2_long').val();
				
				$var= ((parseFloat($lar)/1000) * (parseFloat($haut)/1000)  * 7850 * $long)/1000;
				
				$('#form_larget2_res').attr("value" , $var.toFixed(2));
				
			}
		