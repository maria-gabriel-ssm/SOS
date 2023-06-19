    $(document).ready(function () {
            $('#sidebarCollapse').on('click', function () {
                $('#sidebar, #content').toggleClass('active');
            });
        });
  
  function openiframe(titulo,marca){
    $('#modaltitulo').text(titulo);
    $('#iframemarca').attr("src",marca);
    $('#modaliframe').modal('show');
  }