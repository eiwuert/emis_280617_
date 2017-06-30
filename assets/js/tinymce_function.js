function texteditor(elem){
    tinymce.init({
	    selector: elem,
	    theme: "modern",
	    plugins: [
	        "advlist autolink lists charmap preview hr anchor pagebreak link  contextmenu",
	        "searchreplace wordcount visualblocks visualchars code fullscreen",
	        "save table  directionality",
	        // "insertdatetime nonbreaking emoticons template paste textcolor colorpicker textpattern imagetools media image print"
	    ],
	    toolbar1: "undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image",
	    // toolbar2: "insertfile print preview media | forecolor backcolor emoticons",
	    image_advtab: true,
	    /*templates: [
	        {title: 'Test template 1', content: 'Test 1'},
	        {title: 'Test template 2', content: 'Test 2'}
	    ]*/
	});
}