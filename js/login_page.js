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
  /*
  $('#loginnbtn').on('click', function(e){

    var username = $('#username').val();
    var pass = $('#pass').val();
    if ($('#loginform').valid() ) {
        if(md5(pass) == md5('admin')){
            alert('login successful');
        }
        else{
            alert('Incorrect Password')
            return false;
        }
        
    }
  });*/