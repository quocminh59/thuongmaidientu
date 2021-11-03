import base from './baseurl';

export function selectFileWithCKFinder( elementId, array ) {
	CKFinder.modal( {
		chooseFiles: true,
		width: 800,
		height: 600,
		onInit: function( finder ) {
			finder.on( 'files:choose', function( evt ) {
				var file = evt.data.files.first();
				console.log(file);
				var output = document.getElementById( elementId );
				var urlFile = file.getUrl().split(`${base}`);
				array.push(urlFile[1]);
				output.value = urlFile[1];
			} );

			finder.on( 'file:choose:resizedImage', function( evt ) {
				var output = document.getElementById( elementId );
				output.value = evt.data.resizedUrl;
			} );
		}
	} );
}

export function selectMultiFileWithCKFinder( elementId , array) {
	CKFinder.modal( {
		chooseFiles: true,
		width: 800,
		height: 600,
		onInit: function( finder ) {
			finder.on( 'files:choose', function( evt ) {
				var file = evt.data.files.first();
				var output = document.getElementById( elementId );
				var urlFile = file.getUrl().split(`${base}`);
                array.push(urlFile[1]);
				output.value = array;
			} );

			finder.on( 'file:choose:resizedImage', function( evt ) {
				var output = document.getElementById( elementId );
				output.value = evt.data.resizedUrl;
			} );
		}
	} );
}
