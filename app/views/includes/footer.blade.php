<!-- script references -->
<script src="{{ asset('js/jquery.min.js') }}"></script>
<script src="{{ asset('js/bootstrap.min.js') }}"></script>
<script src="{{ asset('js/bootstrap-select.min.js') }}"></script>
<script src="{{ asset('js/codemirror.js') }}"></script>
<script src="{{ asset('js/sql.js') }}"></script>
<script src="{{ asset('js/scripts.js') }}"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.0/js/toastr.min.js"></script>
<script>
    var textAreas = [];
    (function() {
        $("body").tooltip({ selector: '[data-toggle=tooltip]' }).popover({
         selector: '[data-toggle=popover]', html: true, trigger: 'focus', container: 'body'
        });

        $('.textarea-highlight').each(function() {
            textAreas.push(CodeMirror.fromTextArea(this, {
                mode: $(this).data('mode'),
                lineNumbers: true,
                matchBrackets: true
            }));
            if ($(this).data('conf') == "readOnly")
                textAreas[textAreas.length - 1].setOption('readOnly', 'nocursor');
        });

        $(".spoiler-trigger").click(function() {
            $(this).parent().next().collapse('toggle');
            $.each(textAreas, function(key, value) {    // refresh all textareas to guarantee correct display
                value.refresh();
            })
        });

        $(".confirm").click(function(e) {
            return confirm($(this).data('confirm'));
        });

        toastr.options.positionClass = 'toastr-top-margin';
    })();
</script>
{{ Toastr::render() }}
@yield('custom-js')