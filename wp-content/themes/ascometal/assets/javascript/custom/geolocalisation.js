   function getLocation(){
      console.log("Entering getLocation()");
      if(navigator.geolocation){
      navigator.geolocation.getCurrentPosition(
      displayCurrentLocation,
      displayError,
      { 
        maximumAge: 3000, 
        timeout: 5000, 
        enableHighAccuracy: true 
      });
    }else{
      console.log("Oops, no geolocation support");
    } 
      console.log("Exiting getLocation()");
    };
	
    function displayCurrentLocation(position){
      console.log("Entering displayCurrentLocation");
      var latitude = position.coords.latitude;
    var longitude = position.coords.longitude;
    console.log("Latitude " + latitude +" Longitude " + longitude);
    getAddressFromLatLang(latitude,longitude);
      //  alert(getCityFromLatLong(latitude,longitude));
    console.log("Exiting displayCurrentLocation");
    }
	
	
   function  displayError(error){
    console.log("Entering ConsultantLocator.displayError()");
    var errorType = {
      0: "Unknown error",
      1: "Permission denied by user",
      2: "Position is not available",
      3: "Request time out"
    };
    var errorMessage = errorType[error.code];
    if(error.code == 0  || error.code == 2){
      errorMessage = errorMessage + "  " + error.message;
    }
    alert("Error Message " + errorMessage);
    console.log("Exiting ConsultantLocator.displayError()");
  }

    function getAddressFromLatLang(lat,lng){
      console.log("Entering getAddressFromLatLang()");
      var geocoder = new google.maps.Geocoder();
        var latLng = new google.maps.LatLng(lat, lng);
        geocoder.geocode( { 'latLng': latLng}, function(results, status) {
        console.log("After getting address");
        console.log(results);
        if (status == google.maps.GeocoderStatus.OK) {
          if (results[1]) {
            console.log(results[1]);
			
			//alert(results[4].formatted_address);
			switch(results[5].formatted_address){
				//monde 
				case 'United-State': $('#offcallnumber').text('+1 914 332 7550');break;
				case 'Canada': $('#offcallnumber').text('+1 914 332 7550');break;
				case 'Australia': $('#offcallnumber').text('+33 1 42 38 74 25');break;
				case 'India': $('#offcallnumber').text('+33 1 42 38 74 25');break;
				case 'Chine': $('#offcallnumber').text('+33 1 42 38 74 25');break;
				// europe
				case 'Deuchland': $('#offcallnumber').text('+ 49 211 924 797 0');break;
				case 'Italia': $('#offcallnumber').text('+ 39 030 305 848');break;
				case 'Espana': $('#offcallnumber').text(' + 34 93 363 1973');break;
				case 'England': $('#offcallnumber').text('+ 44 161 886 0368');break;	
				// france
				alert(results[4].formatted_address);
				case 'France':switch(results[4].formatted_address){
									// france-Est
									case 'Lorraine, France': $('#offcallnumber').text('+33 3 87 70 50 89');break; 
									case 'Alsace, France': $('#offcallnumber').text('+33 3 87 70 50 89');break;
									case 'Champagne-Ardenne, France': $('#offcallnumber').text('+33 3 87 70 50 89');break;
									case 'Bourguogne, France': $('#offcallnumber').text('+33 3 87 70 50 89');break;
									case 'Franche-Comté, France': $('#offcallnumber').text('+33 3 87 70 50 89');break;
									case 'Rhone, France': $('#offcallnumber').text('+33 3 87 70 50 89');break;
									// france-Nord
									case 'Nord-Pas-de-Calais, France': $('#offcallnumber').text('+33 3 28 29 60 20');break;
									case 'Picardie, France': $('#offcallnumber').text('+33 3 28 29 60 20');break;
									case 'Normandie, France': $('#offcallnumber').text('+33 3 28 29 60 20');break;
									case 'Bretagne, France': $('#offcallnumber').text('+33 3 28 29 60 20');break;
									// france-Centre
									case 'Rhone-Alpes, France': $('#offcallnumber').text('+33 4 77 45 51 54');break;
									case 'Loire, France': $('#offcallnumber').text('+33 4 77 45 51 54');break;
									case 'Centre, France': $('#offcallnumber').text('+33 4 77 45 51 54');break;
									case 'Poitou, France': $('#offcallnumber').text('+33 4 77 45 51 54');break;
									case 'Limousin, France': $('#offcallnumber').text('+33 4 77 45 51 54');break;
									case 'Auvergne, France': $('#offcallnumber').text('+33 4 77 45 51 54');break;
									// france-Sud
									case 'Corse, France': $('#offcallnumber').text('+33 04 42 47 92 31');break;
								 	case 'Provence-Alpes-Côte-d\'Azure, France': $('#offcallnumber').text('+33 04 42 47 92 31');break;
									case 'Languedoc-Roussillon': $('#offcallnumber').text('+33 04 42 47 92 31');break;
									case 'Midi-Pyrénées, France': $('#offcallnumber').text('+33 04 42 47 92 31');break;
									case 'Aquitaine, France': $('#offcallnumber').text('+33 04 42 47 92 31');break;
                                    // autres
                                    
                                    // par defaut
									default:$('#offcallnumber').text('+ 33 1 42 38 74 66');
                                   
								};break;
				default:$('#offcallnumber').text('+ 33 1 42 38 74 26');
				 }
				 
						
          }
        }
        else
        {
          alert("Geocode was not successful for the following reason: " + status);
        }
        });
      console.log("Entering getAddressFromLatLang()");
    }