<!-- Le javascript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->

<!-- Jquery -->
<script src="../assets/admin/js/jquery-1.11.1.min.js"></script>

<!-- Bootstrap -->
<script src="../assets/admin/bootstrap/js/bootstrap.min.js"></script>

<!-- Flot -->
<script src='../assets/admin/js/jquery.flot.min.js'></script>

<!-- Slimscroll -->
<script src='../assets/admin/js/jquery.slimscroll.min.js'></script>

<!-- Morris -->
<script src='../assets/admin/js/rapheal.min.js'></script>	
<script src='../assets/admin/js/morris.min.js'></script>	

<!-- Datepicker -->
<script src='../assets/admin/js/uncompressed/datepicker.js'></script>

<!-- Sparkline -->
<script src='../assets/admin/js/sparkline.min.js'></script>

<!-- Skycons -->
<script src='../assets/admin/js/uncompressed/skycons.js'></script>

<!-- Popup Overlay -->
<script src='../assets/admin/js/jquery.popupoverlay.min.js'></script>

<!-- Easy Pie Chart -->
<script src='../assets/admin/js/jquery.easypiechart.min.js'></script>

<!-- Sortable -->
<script src='../assets/admin/js/uncompressed/jquery.sortable.js'></script>

<!-- Owl Carousel -->
<script src='../assets/admin/js/owl.carousel.min.js'></script>

<!-- Modernizr -->
<script src='../assets/admin/js/modernizr.min.js'></script>

<!-- Simplify -->
<script src="../assets/admin/js/simplify/simplify.js"></script>
<script src="../assets/admin/js/simplify/simplify_dashboard.js"></script>


<script>
    $(function()	{
        $('.chart').easyPieChart({
            easing: 'easeOutBounce',
            size: '140',
            lineWidth: '7',
            barColor: '#7266ba',
            onStep: function(from, to, percent) {
                $(this.el).find('.percent').text(Math.round(percent));
            }
        });

        $('.sortable-list').sortable();

        $('.todo-checkbox').click(function()	{
            
            var _activeCheckbox = $(this).find('input[type="checkbox"]');

            if(_activeCheckbox.is(':checked'))	{
                $(this).parent().addClass('selected');					
            }
            else	{
                $(this).parent().removeClass('selected');
            }
        
        });

        //Delete Widget Confirmation
        $('#deleteWidgetConfirm').popup({
            vertical: 'top',
            pagecontainer: '.container',
            transition: 'all 0.3s'
        });
    });
    
</script>