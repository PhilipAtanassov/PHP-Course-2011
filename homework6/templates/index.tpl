<html>
<head>
<title>{$title}</title>
{foreach $cssFiles as $css}
{strip}
<link rel="stylesheet" href="{$css}" type="text/css" media="screen" />
{/strip}
{/foreach}

{foreach $jsFiles as $js}
{strip}
<script src="{$js}" type="text/javascript" language="javascript" charset="utf-8"></script>
{/strip}
{/foreach}

</head>
<body>
{$message}
{$message1}
</body>
</html>