<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    @vite(['resources/sass/app.scss', 'resources/js/app.js', 'resources/js/particles.js', 'resources/js/app.particles.js'])
</head>
<body>

<div id="particles-js">
    <h1>Hovno</h1>
</div>



<script type="module">
    // Vite automaticky spravuje načítanie JavaScriptových súborov, nemusíte uvádzať cestu
    import '/resources/js/app.particles.js';
</script>
</body>
</html>
