<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
<script>
    if (!window.jQuery.ui) {
        document.write('<script src="/assets/themes/js/libs/jquery-ui-1.10.3.min.js"><\/script>');
    }
</script>

<!-- IMPORTANT: APP CONFIG -->
<script src="/assets/themes/js/app.config.js"></script>

<!-- JS TOUCH : include this plugin for mobile drag / drop touch events-->
<script src="/assets/themes/js/plugin/jquery-touch/jquery.ui.touch-punch.min.js"></script> 

<!-- BOOTSTRAP JS -->
<script src="/assets/themes/js/bootstrap/bootstrap.min.js"></script>

<!-- JARVIS WIDGETS -->
<script src="/assets/themes/js/smartwidgets/jarvis.widget.min.js"></script>

<!-- JQUERY VALIDATE -->
<script src="/assets/themes/js/plugin/jquery-validate/jquery.validate.min.js"></script>

<!-- JQUERY SELECT2 INPUT -->
<script src="/assets/themes/js/plugin/select2/select2.min.js"></script>

<!-- browser msie issue fix -->
<script src="/assets/themes/js/plugin/msie-fix/jquery.mb.browser.min.js"></script>

<!-- MAIN APP JS FILE -->
<script src="/assets/themes/js/app.min.js"></script>

<!-- PAGE RELATED PLUGIN(S) -->

<script src="/assets/themes/js/plugin/bootstrap-timepicker/bootstrap-timepicker.min.js"></script>
<script src="/assets/themes/js/plugin/clockpicker/clockpicker.min.js"></script>
<script src="/assets/themes/js/plugin/bootstrap-tags/bootstrap-tagsinput.min.js"></script>
<script src="/assets/themes/js/plugin/noUiSlider/jquery.nouislider.min.js"></script>
<script src="/assets/themes/js/plugin/ion-slider/ion.rangeSlider.min.js"></script>
<script src="/assets/themes/js/plugin/colorpicker/bootstrap-colorpicker.min.js"></script>
<script src="/assets/themes/js/plugin/knob/jquery.knob.min.js"></script>
<script src="/assets/themes/js/plugin/x-editable/moment.min.js"></script>
<script src="/assets/themes/js/plugin/x-editable/jquery.mockjax.min.js"></script>
<script src="/assets/themes/js/plugin/x-editable/x-editable.min.js"></script>
<script src="/assets/themes/js/plugin/typeahead/typeahead.min.js"></script>
<script src="/assets/themes/js/plugin/typeahead/typeaheadjs.min.js"></script>

<script type="text/javascript">

    // DO NOT REMOVE : GLOBAL FUNCTIONS!

    $(document).ready(function() {
        $('.datepicker').datepicker({
            format: 'mm/dd/yyyy',
            startDate: '-3d'
        })
        pageSetUp();
    })

</script>

<script type="text/javascript" src="/assets/js/jquery.typing-0.2.0.min.js"></script>