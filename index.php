<?php
$showInMeta = !empty($_GET['meta']);
$showHeader = !empty($_GET['header']);
$forceTT = !empty($_GET['force']);

$policy = 'trusted-types *;';
if ($forceTT) {
    $policy .= ' require-trusted-types-for \'script\';';
} 

if ($showHeader) {
    header('Content-Security-Policy: ' . $policy);
}
?>
<html>
<head>
<meta charset="utf-8">
<?php if ($showInMeta): ?>
<meta http-equiv="Content-Security-Policy" content="<?php echo($policy); ?>">
<?php endif; ?>
<title>Trusted types test</title>
<script src="trustedtypes.build.js" data-csp="<?php echo($policy); ?>"></script>
</head>
<body>

<section>
<p><strong>Opcje</strong></p>

<form method="get" action="">
<p><input type="checkbox" name="meta" <?php echo($showInMeta?'checked':''); ?>> <em>Wstaw CSP w tagu meta</em></p>
<p><input type="checkbox" name="header" <?php echo($showHeader?'checked':''); ?>> <em>Wstaw CSP w nagłówku</em></p>
<p><input type="checkbox" name="force" <?php echo($forceTT?'checked':''); ?>> <em>Wymuś stosowanie Trusted Types</em></p>
<p><button type="submit">Wyślij</button></p>
</form>
</section>

<section>
<p><strong>Polityka</strong></p>
<pre><?php echo($policy); ?></pre>
</section>

<hr>

<div id="raw"></div>

<script>
const dirty = '<p onclick=alert(2)>HELLO<iframe srcdoc="<script>alert(1)</scr'+'ipt>"></ifrAMe><br>goodbye</p>';
const raw  = document.getElementById('raw');
raw.innerHTML = dirty;
</script>

<script>
const script = document.createElement('script');
script.src = 'test.js'
document.body.appendChild(script)
</script>


</body>
</html>