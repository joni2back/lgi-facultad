    <script>
    !function ($) {
      $(function(){
        // carousel demo
        $('#myCarousel').carousel()
      })
    }(window.jQuery);

    $(document).ready(function() {
        $('#article-form').on('submit', function(e) {
            $('.alert.alert-error').hide().html('');
            var hasErrors = false;
            $(this).find('input, select, textarea').each(function() {
                if (! $(this).val()) {
                    hasErrors = true;
                    var input = $(this);
                    input.parent().find('.alert.alert-error').show().css('margin-bottom','15px')
                        .html('<i class="icon-chevron-up"></i> Por favor complete el campo');
                }
            });
            hasErrors && e.preventDefault();
        });
    });

    </script>
  </body>
</html>
