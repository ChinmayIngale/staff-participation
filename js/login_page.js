$('.form').find('input, textarea').on('keyup blur focus', function (e) {
  
    var $this = $(this),
        label = $this.prev('label');
  
        if (e.type === 'keyup') {
              if ($this.val() === '') {
            label.removeClass('active highlight');
          } else {
            label.addClass('active highlight');
          }
      } else if (e.type === 'blur') {
          if( $this.val() === '' ) {
              label.removeClass('active highlight'); 
              } else {
              label.removeClass('highlight');   
              }   
      } else if (e.type === 'focus') {
        
        if( $this.val() === '' ) {
              label.removeClass('highlight'); 
              } 
        else if( $this.val() !== '' ) {
              label.addClass('highlight');
              }
      }
  
  });

  //show password

	document.querySelector('.eye').addEventListener('click',function () {
		var x = document.getElementById("pass");
		if (x.type === "password") {
			x.type = "text";
			document.querySelector('.eye').innerHTML = '<i class="fa fa-eye-slash" aria-hidden="true" style="font-size: 1.2em;"></i> show password';
		} else {
			x.type = "password";
			document.querySelector('.eye').innerHTML = '<i class="fa fa-eye" aria-hidden="true" style="font-size: 1.2em;"></i> show password';
		}
	});

  