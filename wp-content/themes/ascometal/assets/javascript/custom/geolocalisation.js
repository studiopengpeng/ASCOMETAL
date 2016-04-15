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
				case 'United-State': $('#asco-layout-phone-input').text('+1 914 332 7550');break;
				case 'Canada': $('#asco-layout-phone-input').text('+1 914 332 7550');break;
				case 'Australia': $('#asco-layout-phone-input').text('+33 1 42 38 74 25');break;
				case 'India': $('#asco-layout-phone-input').text('+33 1 42 38 74 25');break;
				case 'Chine': $('#asco-layout-phone-input').text('+33 1 42 38 74 25');break;
				// europe
				case 'Deuchland': $('#asco-layout-phone-input').text('+ 49 211 924 797 0');break;
				case 'Italia': $('#asco-layout-phone-input').text('+ 39 030 305 848');break;
				case 'spagna': $('#asco-layout-phone-input').text(' + 34 93 363 1973');break;
				case 'England': $('#asco-layout-phone-input').text('+ 44 161 886 0368');break;	
				// france
				alert(results[4].formatted_address);
				case 'France':switch(results[4].formatted_address){
									// france-Est
									case 'Lorraine, France': $('#asco-layout-phone-input').text('+33 3 87 70 50 89');break; 
									case 'Alsace, France': $('#asco-layout-phone-input').text('+33 3 87 70 50 89');break;
									case 'Champagne-Ardrenne, France': $('#asco-layout-phone-input').text('+33 3 87 70 50 89');break;
									case 'Bourguogne, France': $('#asco-layout-phone-input').text('+33 3 87 70 50 89');break;
									case 'Franche-Conté, France': $('#asco-layout-phone-input').text('+33 3 87 70 50 89');break;
									case 'Rhone, France': $('#asco-layout-phone-input').text('+33 3 87 70 50 89');break;
									// france-Nord
									case 'Nord-Pas-de-Calais, France': $('#asco-layout-phone-input').text('+33 3 28 29 60 20');break;
									case 'Piccardie, France': $('#asco-layout-phone-input').text('+33 3 28 29 60 20');break;
									// france-Centre
									case 'Auvergne, France': $('#asco-layout-phone-input').text('+33 4 77 45 51 58');break;
									case 'Rhone-Alpes, France': $('#asco-layout-phone-input').text('+33 4 77 45 51 58');break;
									// france-Sud
									case 'Corse, France': $('#asco-layout-phone-input').text('+33 04 42 47 92 31');break;
								 	case 'Provence-Alpes-Côte-d\'Azure, France': $('#asco-layout-phone-input').text('+33 04 42 47 92 31');break;
									case 'Languedoc-Roussillon': $('#asco-layout-phone-input').text('+33 04 42 47 92 31');break;
									case 'Midi-Pyrènées, France': $('#asco-layout-phone-input').text('+33 04 42 47 92 31');break;
									case 'Aquitaine, France': $('#asco-layout-phone-input').text('+33 04 42 47 92 31');break;
									default:$('#asco-layout-phone-input').text('+33 1 42 38 74 54');
								};break;
				default:$('#asco-layout-phone-input').text('+ 33 1 42 38 74 26 ');
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