<script type="text/javascript">
    moment.locale('{{ app()->getLocale() }}');

    App.init({
        debug: {{ app()->environment('dev') ? 'true' : 'false' }},
        host: '{{ config('app.host') }}'
    });
</script>