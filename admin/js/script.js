$(document).ready( function() {
    // EDITOR CKEDITO
    ClassicEditor
            .create( document.querySelector( '#body' ) )
            .catch( error => {
                console.error( error );
            } );

    //Check Box
    $('#selectAllBoxes').click(function(event){
        if(this.checked) {
            $('.checkBoxes').each(function(){
                this.checked = true;                 
            });
        } else {
            $('.checkBoxes').each(function(){
                this.checked = false;                 
            });
        }
    });


});
