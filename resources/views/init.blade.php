<script type="text/javascript">
    var appConfig = {
        debug: {{ app()->environment('dev') ? 'true' : 'false' }},
        host: '{{ config('app.host') }}'
    };

    App.init(appConfig);
</script>